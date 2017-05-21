<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Symfony\Component\Console\Helper\Table;

class IndexController extends Controller
{
    public function Classm(Request $request){
        $info = $request->all();
        $output = DB::table('class')->where('class',$info['classid'])->get();

        if(!empty($output)){
            dd($output);
        }else{
            $subject = $this->getHTML('http://jwzx.cqupt.edu.cn/jwzxtmp/showBjStu.php?bj='.$info['classid']);
            $pattern = "/<td>(.*?)<\/td>/i";
            preg_match_all($pattern, $subject, $matches);
            try {
                while(1) {
                    if(@$matches[1][$x] == NULL) {
                        break;
                    }
                    $data = array();
                    for($k = 1; $k < 10; $k++) {
                        $data[] = $matches[1][$x + $k];
                    }
                    $status = DB::table('class')->insert([
                        'id'            =>      $data[0],
                        'name'          =>      $data[1],
                        'sex'           =>      $data[2],
                        'class'         =>      $data[3],
                        'majorNum'      =>      $data[4],
                        'major'         =>      $data[5],
                        'college'        =>      $data[6],
                        'grade'         =>      $data[7],
                        'status'    =>      $data[8]
                    ]);
                    if($status) {
                        $x = $x +10;
                    } else {
                        echo "添加失败";
                        break;
                    }
                }
            } catch (Exception $e) {
                echo $e;
                echo 'over';
                exit(0);
            }

            $output = DB::table('class')->where('class',$info['classid'])->get();
            dd($output);
        }
    }
    public function std(Request $request){
        $info = $request->all();
        $result = DB::table('kecheng')->where('id',$info['stuid'])->get();
        if(!empty($result)){
            dd($result[0]);
        }else{
            $subject = $this->getHTML('http://jwzx.cqupt.edu.cn/jwzxtmp/kebiao/kb_stu.php?xh='.$info['stuid']);
            $pattern = "/<tr[^>]*?><td[^>]*?>(.*?)<\/td><td[^>]*?>(.*?)<\/td><td[^>]*?>(.*?)<\/td><td[^>]*?>(.*?)<\/td><td[^>]*?>(.*?)<\/td><td[^>]*?>(.*?)<\/td><td[^>]*?>(.*?)<\/td><td[^>]*?>(.*?)<\/td><\/tr>/s";
            $subject = $this->dealHTML($subject);
            preg_match_all($pattern, $subject, $output);
            $data[] = $info['stuid'];
            $data = $this->dealoutputarray($output,$data);
            // DB::insert('insert into kecheng VALUES (id,,,,,,,,,)',$data);//暂时不知如何建表 如果用这样的方式建表  很乱 如果用联合查询  =、=  暂时不会怎么联合加入....
            $result = DB::table('kecheng')->where('id',$info['stuid'])->get();
            dd($result[0]);
        }
    }

    private function getHTML($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $subject = curl_exec($ch);
        curl_close($ch);
        return $subject;
    }

    private function dealHTML($subject){
        $subject = str_replace("	",'',$subject);
        $subject = preg_replace('/<a[^>]*?>(.*?)<\/a>/','',$subject);
        $subject = preg_replace('/\\s/','',$subject);
        $subject = str_replace('<fontcolor=#FF0000></font><br><spanstyle=\'color:#0000FF\'>', '<br>',$subject);
        $subject = preg_replace('/<span[^>]*?>/','',$subject);
        $subject = str_replace('</span><br><b></b>','',$subject);
        $subject = str_replace('</span><divstyle=\'background:#FFFFC0;\'>','',$subject);
        $subject = str_replace('</div><br><b></b>','',$subject);
        $subject = str_replace('<fontcolor=#FF0000>4节连上</font>','4节连上',$subject);
        $subject = preg_replace('/[0-9A-Za-z]+<br>[0-9A-Za-z]+([\\s]+)?[-](?=[C]?[\x{4e00}-\x{9fa5}]+)/u','',$subject);
        $subject = str_replace('<hr>',' ',$subject);
        $subject = str_replace('<br>',' ',$subject);
        $subject = str_replace('地点：','',$subject);
        return $subject;
    }

    private function dealoutputarray($output,$data){
        array_shift($output);
        array_shift($output);
        for ($i=0; $i<=6; $i++) {
            array_pop($output[$i]);
            array_splice($output[$i], 0, 1);
            array_splice($output[$i], 2, 1);
            array_splice($output[$i], 4, 1);
            array_splice($output[$i], 6, 13);
        }

        foreach ($output as $valve){
            foreach ($valve as $value2){
                $data[] = $value2;
            }
        }
        return $data;
    }


}
