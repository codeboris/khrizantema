<?php
namespace common\components;

use Yii;
use \yii\helpers\VarDumper;
use \yii\log\Logger;

class EmailTarget extends \yii\log\EmailTarget
{
    public function init()
    {
        parent::init();
    }

    public function export()
    {
        parent::export();
    }

    protected function composeMessage($body)
    {
        $message = $this->mailer->compose(
            ['html' => 'log/html'],
            ['message' => $body]
        );

        Yii::configure($message, $this->message);

        return $message;
    }

    public function formatMessage($message)
    {
        list($text, $level, $category, $timestamp) = $message;
        $level = Logger::getLevelName($level);
        if (!is_string($text)) {
            // exceptions may not be serializable if in the call stack somewhere is a Closure
            if ($text instanceof \Exception) {
                $text = (string) $text;
            } else {
                $text = VarDumper::export($text);
            }
        }
        $traces = [];
        if (isset($message[4])) {
            foreach ($message[4] as $trace) {
                $traces[] = "in {$trace['file']}:{$trace['line']}";
            }
        }

        $prefix = $this->getMessagePrefix($message);

        return Yii::$app->formatter->asDatetime($timestamp) . " {$prefix}[$level][$category] $text"
            . (empty($traces) ? '' : "\n    " . implode("\n    ", $traces));
    }

    /*
    protected function processLogs($logs) {
        $message = '';

        foreach($logs as $log)
            $message .= ((!empty($message)) ? '<br /><br />' : '').$this->formatLogMessage($log[0],$log[1],$log[2],$log[3]);

        $message = wordwrap($message,70);

        $subject = $this->getSubject();
        if ($subject === null)
            $subject = Yii::t('yii','Application Log');

        $this->sendEmail($subject, $message);
    }

    protected function sendEmail($subject, $message) {

        $message = str_replace(array("\n"), array('<br />'), $message);

        //TLog::log('emaillog.txt', $message);

        $emailer = Yii::app()->emailer;
        $emailer->getView('applicationlog', array('message' => $message));


        foreach($this->getEmails() as $email)
            $emailer->addAddress($email);

        $emailer->Subject = $subject;

        $emailer->send();
    }
    */
}
