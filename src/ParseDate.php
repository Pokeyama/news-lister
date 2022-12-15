<?php

namespace Adm;

use DateTime;
use Exception;

/**
 * スクレイピングしてきた日付の文字列をDateTimeに解析するクラス
 */
class ParseDate
{
    /**
     * @var DateTime 現在時刻
     */
    public DateTime $nowDate;

    /**
     * iniにタイムゾーンが設定されていない場合、一度だけ設定可能
     */
    private static function initTimeZone(): void
    {
        // iniでタイムゾーン指定してないのに切り替わらないから無理やり変える
        date_default_timezone_set("Asia/Tokyo");
    }

    /**
     * 現在日時をY-m-d H:i:sフォーマットで返す
     * @return string 現在日時
     * @throws Exception 内部エラー
     */
    public static function now(): string
    {
        self::initTimeZone();
        return (new DateTime())->format("Y-m-d H:i:s");
    }

    /**
     * 現在の渡された日の時間差を1時間単位で返す
     * @param string $param 比較したい日時
     * @return int 日数差
     * @throws Exception
     */
    public static function diffDay(string $param): int
    {
        $diffDay = (new DateTime(self::now()))->diff(new DateTime($param));
        return $diffDay->days * 24 + $diffDay->h;
    }

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        self::initTimeZone();
        $this->nowDate = new DateTime();
    }

    /**
     * Yahooニュースの日付をdatetime型に解析
     * 6/9(木) 16:59 -> 2022/6/9 16:59:00
     * @param string $param
     * @return DateTime
     * @throws Exception
     */
    public function parseYahooDate(string $param): string
    {
        // 空白で分割して配列に格納
        $arr = explode(" ", $param);
        // 曜日の文字列を取り除く
        $mmss = preg_replace('/\(.\)/u', '', $arr[0]);
        // 現在の年数と取り出した時分、秒数をくっつけて文字列にする
        // 解析した文字列からDateTimeインスタンスを返す
        return $this->nowDate->format("Y/" . $mmss . " " . $arr[1]);
    }
    
    /**
     * ITmediaの日付をdatetime型に解析
     * （9月6日 13時00分） -> 2022/9/6 13:00:00
     * @param string $param
     * @return DateTime
     * @throws Exception
     */
    public function parseITMediaDate(string $param): string
    {
        // （）を取り除く
        $tmp = mb_ereg_replace('[（）日分]', '', $param);
        $tmp = mb_ereg_replace('[月]', '/', $tmp);
        $tmp = mb_ereg_replace('[時]', ':', $tmp);
        // 空白で分割して配列に格納
        $arr = explode(" ", $tmp);
        // 現在の年数と取り出した時分、秒数をくっつけて文字列にする
        // 解析した文字列からDateTimeインスタンスを返す
        return $this->nowDate->format("Y/" . $arr[0] . " " . $arr[1]);
    }

}