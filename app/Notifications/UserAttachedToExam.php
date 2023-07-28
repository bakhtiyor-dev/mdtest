<?php

namespace App\Notifications;

use App\Models\Exam;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAttachedToExam extends Notification
{
    protected $exam;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Уведомление о предстоящем экзамене')
            ->greeting("Уважаемый $notifiable->fullname!")
            ->line("С {$this->exam->start_date} до {$this->exam->end_date} вы должны пройти экзамен со следующими данными:")
            ->lines([
                "Название экзамена: {$this->exam->title}",
                "Подразделение: {$this->exam->organisation->title}",
                "Отдел: {$this->exam->department->title}",
                "Время: {$this->exam->time} минут",
                "Количество попыток: {$this->exam->attempts_count}",
                "Количество вопросов: {$this->exam->tests_count}"
            ])
            ->action('Перейти к экзамену', route('exam.attempts',$this->exam))
            ->salutation(' ');
    }

}
