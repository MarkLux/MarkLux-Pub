<?php
/**
 * Created by PhpStorm.
 * User: lumin
 * Date: 17/5/4
 * Time: 下午4:49
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use PHPExcel;
use App\Exceptions\FormValidationException;
use App\Exceptions\InnerErrorException;
use App\Exceptions\PasswordErrorException;
use App\Exceptions\PhoneExistException;
use App\Models\PowerBuilderForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PowerBuilderFormController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:45',
            'name' => 'required|string|max:45',
            'qq' => 'required|string|max:45',
            'nick_name' => 'required|string|max:100',
            'sex' => 'required|string|max:10',
            'age' => 'required|integer',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'company' => 'required|string|max:100',
            'duty' => 'required|string|max:100',
            'arrival_time' => 'required|date|after:now',
            'need_room' => 'required|boolean',
            'room_type' => 'string|max:100',
            'days' => 'integer',
            'self_lunch_count' => 'required|integer',
            'need_receipt' => 'required|boolean',
            'receipt_header' => 'string',
            'total_price' => 'required|integer'
        ]);

        if ($validator->fails()) {
            throw new FormValidationException($validator->getMessage()->all());
        }

        $old = PowerBuilderForm::where('mobile',$request->input('mobile'))->get()->first();

        if ($old != null) {
            throw new PhoneExistException();
        }

        $new = [
            'mobile' => $request->input('mobile'),
            'name' => $request->input('name'),
            'qq' => $request->input('qq'),
            'sex' => $request->input('sex'),
            'nick_name' => $request->input('nick_name'),
            'age' => $request->input('age'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'company' => $request->input('company'),
            'duty' => $request->input('duty'),
            'arrival_time' => $request->input('arrival_time'),
            'need_room' => $request->input('need_room'),
            'room_type' => $request->input('room_type'),
            'days' => $request->input('days'),
            'self_lunch_count' => $request->input('self_lunch_count'),
            'need_receipt' => $request->input('need_receipt'),
            'receipt_header' => $request->input('receipt_header'),
            'total_price' => $request->input('total_price'),
            'created_at' => new Carbon()
        ];

        $row = DB::table('power_builder_forms')->insert($new);

        if ($row != 1) {
            throw new InnerErrorException('无法提交！');
        }

        return response()
            ->json([
            'code' => 0
        ]);
    }

    public function getResult(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new FormValidationException($validator->getMessage()->all());
        }

        $password = $request->input('password');

        if (strcmp($password,'NEUQer') != 0) {
            throw new PasswordErrorException();
        }

        $all = PowerBuilderForm::all();

        $phpExcelObj = new PHPExcel();

        $phpExcelObj->getProperties()
            ->setTitle('PowerBuilder报名结果统计');

        // 设置表头

        $phpExcelObj->setActiveSheetIndex(0)
            ->setCellValue('A1','手机号')
            ->setCellValue('B1','姓名')
            ->setCellValue('C1','QQ号')
            ->setCellValue('D1','昵称')
            ->setCellValue('E1','性别')
            ->setCellValue('F1','年龄')
            ->setCellValue('G1','省份')
            ->setCellValue('H1','城市')
            ->setCellValue('I1','公司名称')
            ->setCellValue('J1','职务')
            ->setCellValue('K1','预计到达日期')
            ->setCellValue('L1','是否需要订房')
            ->setCellValue('M1','房间类型')
            ->setCellValue('N1','订房天数')
            ->setCellValue('O1','午餐自助餐数量')
            ->setCellValue('P1','是否需要发票')
            ->setCellValue('Q1','发票单位抬头')
            ->setCellValue('R1','报名时间')
            ->setCellValue('S1','总金额');

        // 设置单元格内容

        $i = 1;

        foreach ($all as $single) {
            $i++;
            $phpExcelObj->getActiveSheet(0)
                ->setCellValue('A'.$i,$single->mobile)
                ->setCellValue('B'.$i,$single->name)
                ->setCellValue('C'.$i,$single->qq)
                ->setCellValue('D'.$i,$single->nick_name)
                ->setCellValue('E'.$i,$single->sex)
                ->setCellValue('F'.$i,$single->age)
                ->setCellValue('G'.$i,$single->province)
                ->setCellValue('H'.$i,$single->city)
                ->setCellValue('I'.$i,$single->company)
                ->setCellValue('J'.$i,$single->duty)
                ->setCellValue('K'.$i,$single->arrival_time)
                ->setCellValue('L'.$i,$single->need_room?"是":"否")
                ->setCellValue('M'.$i,$single->room_type)
                ->setCellValue('N'.$i,$single->days)
                ->setCellValue('O'.$i,$single->self_lunch_count)
                ->setCellValue('P'.$i,$single->need_receipt?"是":"否")
                ->setCellValue('Q'.$i,$single->receipt_header)
                ->setCellValue('R'.$i,$single->created_at)
                ->setCellValue('S'.$i,$single->total_price);
        }

        $phpExcelObj->getActiveSheet()->setTitle('报名结果');

        $phpExcelObj->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=result.xlsx");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcelObj,'Excel2007');

        $objWriter->save('php://output');
    }
}