<?php
/**
 * Created by PhpStorm.
 * User:lumin
 * Date: 17/1/22
 * Time:下午2:01
 */

namespace App\Http\Controllers;

use App\CalendarAct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HLController extends Controller
{
    //在这里修改相关信息
    private $weekday =["日","一","二","三","四","五","六"];

    private $directions = ["北方","东北方","东方","东南方","南方","西南方","西方","西北方"];

    //活动项，自己手动在这里添加
    private $activities = [
        ["name"=>"写单元测试", "good"=>"写单元测试将减少出错","bad"=>"写单元测试会降低你的开发效率"],
        ["name"=>"洗澡", "good"=>"你几天没洗澡了？","bad"=>"会把设计方面的灵感洗掉", "weekend"=>true],
        ["name"=>"锻炼一下身体", "good"=>"强身健体精神好","bad"=>"能量没消耗多少，吃得却更多", "weekend"=>true],
        ["name"=>"白天上线", "good"=>"今天白天上线是安全的","bad"=>"可能导致灾难性后果"],
        ["name"=>"重构", "good"=>"代码质量得到提高","bad"=>"你很有可能会陷入泥潭"],
        ["name"=>"使用%t", "good"=>"你看起来更有品位","bad"=>"别人会觉得你在装逼"],
        ["name"=>"跳槽", "good"=>"该放手时就放手","bad"=>"鉴于当前的经济形势，你的下一份工作未必比现在强"],
        ["name"=>"招人", "good"=>"你面前这位有成为牛人的潜质","bad"=>"这人会写程序吗？"],
        ["name"=>"面试", "good"=>"面试官今天心情很好","bad"=>"面试官不爽，会拿你出气"],
        ["name"=>"提交辞职申请", "good"=>"公司找到了一个比你更能干更便宜的家伙，巴不得你赶快滚蛋","bad"=>"鉴于当前的经济形势，你的下一份工作未必比现在强"],
        ["name"=>"申请加薪", "good"=>"老板今天心情很好","bad"=>"公司正在考虑裁员"],
        ["name"=>"晚上加班", "good"=>"晚上是程序员精神最好的时候","bad"=>"", "weekend"=>true],
        ["name"=>"在妹子面前吹牛", "good"=>"改善你矮穷挫的形象","bad"=>"会被识破", "weekend"=>true],
        ["name"=>"称量体重", "good"=>"发现自己又轻了几斤","bad"=>"屏幕上的数字让你哭的像个三百斤的肥仔", "weekend"=> true],
        ["name"=>"合并代码分支", "good"=>"没有任何冲突","bad"=>"你将溺死在冲突中", "weekend"=>true],
        ["name"=>"和%v一起吃饭", "good"=>"","bad"=>""],
        ["name"=>"写超过%l行的方法", "good"=>"你的代码组织的很好，长一点没关系","bad"=>"你的代码将混乱不堪，你自己都看不懂"],
        ["name"=>"提交代码", "good"=>"遇到冲突的几率是最低的","bad"=>"你遇到的一大堆冲突会让你觉得自己是不是时间穿越了"],
        ["name"=>"代码复审", "good"=>"发现重要问题的几率大大增加","bad"=>"你什么问题都发现不了，白白浪费时间"],
        ["name"=>"开会", "good"=>"写代码之余放松一下打个盹，有益健康","bad"=>"小心被扣屎盆子背黑锅"],
        ["name"=>"打游戏", "good"=>"一路躺赢","bad"=>"遇见的队友全是坑", "weekend"=> true],
        ["name"=>"晚上上线", "good"=>"晚上是程序员精神最好的时候","bad"=>"你白天已经筋疲力尽了"],
        ["name"=>"修复BUG", "good"=>"你今天对BUG的嗅觉大大提高","bad"=>"新产生的BUG将比修复的更多"],
        ["name"=>"设计评审", "good"=>"设计评审会议将变成头脑风暴","bad"=>"人人筋疲力尽，评审就这么过了"],
        ["name"=>"需求评审", "good"=>"","bad"=>""],
        ["name"=>"上微博", "good"=>"今天发生的事不能错过","bad"=>"今天的微博充满负能量", "weekend"=> true],
        ["name"=>"上AB站", "good"=>"还需要理由吗？","bad"=>"满屏兄贵亮瞎你的眼", "weekend"=> true],
        ["name"=>"使用steam", "good"=>"今天会玩的很开心","bad"=>"除非你想剁手", "weekend"=> true]
    ];

    private $tools = ["Eclipse写程序", "MSOffice写文档", "记事本写程序", "Windows10", "Linux", "MacOS", "IE", "Android设备", "iOS设备"];

    private $drinks = ["水","茶","红茶","绿茶","咖啡","奶茶","可乐","鲜奶","豆奶","果汁","果味汽水","苏打水","运动饮料","酸奶","酒"];

    private $foods = ["拔丝蛋糕","张姐烤肉饭","玉米","拉面","蛋包饭","炒饭","汉堡","煎饼","东北菜馆"];

    //日期变量
    private $today;

    //人名变量
    private $names = ["嘉俊","ht","yz","boss","妹子","ios","老板"];

    //计算用种子
    private $iday;

    //视图变量
    private $good,$bad;

    public function __construct()
    {
        $this->today = Carbon::today();
        $this->iday = $this->today->year * 10000 + ($this->today->month + 1) * 100 + $this->today->day;
        $this->good = [];
        $this->bad = [];
    }

    public function index()
    {
        $dateSring = $this->getDateString();

        $this->pickUpTodaysLuck();

        $drinks = $this->pickRandom($this->drinks,2);

        $direction = $this->pickRandom($this->directions,1);

        $stars = $this->star($this->getRandom($this->iday,6)%5+1);

        $foods = $this->pickRandom($this->foods,3);

        $daysPassed = $this->today->diffInDays(Carbon::create(2017,1,3));

        $viewData = [
            'daysPassed' => $daysPassed,
            'date' => $dateSring,
            'goods' => $this->good,
            'bads' => $this->bad,
            'drinks' => $drinks,
            'direction' => $direction,
            'foods' => $foods,
            'stars' => $stars
        ];

        return view('calendar.main',$viewData);
    }

    private function getDateString()
    {
        return $this->today->year."年".$this->today->month."月".$this->today->day."日"."  周".$this->weekday[$this->today->dayOfWeek];
    }

    //原版随机数,每天生成的随机数字是特定的
    private function getRandom($dayseed, $indexseed)
    {
        $n = $dayseed % 11117;
        for ($i = 0; $i < 100 + $indexseed; $i++)
        {
            $n = $n * $n;
            $n = $n % 11117;   // 11117 是个质数
        }
        return $n;
    }

    //将数字转换为星星
    private function star($num) {
        $result = "";
        $i = 0;
        while ($i < $num) {
            $result .= "★";
            $i++;
        }
        while($i < 5) {
            $result .= "☆";
            $i++;
        }
        return $result;
    }

    private function filter(array $activities)
    {
        $result = [];

        // 周末的话，只留下 weekend = true 的事件
        if ($this->today->isWeekend()) {
            for ($i = 0; $i < count($activities); $i++) {
                if (isset($activities[$i]['weekend'])&&$activities[$i]['weekend'] == true) {
                    $result[] = $activities[$i];
                }
            }
        return $result;
        }

        return $activities;
    }

    //产生今日运势
    private function pickUpTodaysLuck()
    {
        $_activities = $this->filter($this->activities);

        $numGood = $this->getRandom($this->iday, 98) % 3 + 2;
        $numBad = $this->getRandom($this->iday, 87) % 3 + 2;
        $eventArr = $this->pickRandomActivity($_activities, $numGood + $numBad);


        for ($i = 0; $i < $numGood; $i++) {
            array_push($this->good,$eventArr[$i]);
        }

        for ($i = 0; $i < $numBad; $i++) {
            array_push($this->bad,$eventArr[$numGood + $i]);
        }
    }

        // 从 activities 中随机挑选 size 个
     private function pickRandomActivity(array  $activities,int $size)
     {
            $picked_events = $this->pickRandom($activities, $size);

            //随机替换可以替换的内容
            for ($i = 0; $i < count($picked_events); $i++) {
                $picked_events[$i] = $this->parse($picked_events[$i]);
            }

        return $picked_events;
     }

    // 从数组中随机挑选 size 个
     private function pickRandom(array $arr,int $size) {
            $result = [];

            for ($i = 0; $i < count($arr); $i++) {
                $result[] = $arr[$i];
            }

        //根据随机数 删除掉其中的几个
        for ($j = 0; $j <count($arr) - $size; $j++) {
                $index = $this->getRandom($this->iday, $j) % count($result);
                array_splice($result,$index,1);//从随机位置删除一个
            }

        return $result;
    }

    private function parse($event)
    {
        $result = ['name'=> $event['name'], 'good'=>$event['good'],'bad'=>$event['bad']];  // clone

        if(strpos($result['name'],'%v') != false)
        {
            $result['name'] = str_replace('%v',$this->names[$this->getRandom($this->iday, 12) % count($this->names)],$result['name']);
        }

        if(strpos($result['name'],'%t') != false) {
            $result['name'] = str_replace('%t',$this->tools[$this->getRandom($this->iday, 11) % count($this->tools)],$result['name']);
        }

        if(strpos($result['name'],'%l') != false) {
            $result['name'] = str_replace('%l',$this->getRandom($this->iday, 12) % 30 + 247,$result['name']);
        }

        return $result;

    }
}

