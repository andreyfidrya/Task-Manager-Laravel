<?php

namespace App\Enums\Task;

enum Status : int {
    case INPROGRESS = 0;
    case SUBMITTED = 1;
    case APPROVED = 2;
    case PAID = 3;

    public function text(){
        return match($this->value){
            self::INPROGRESS->value => 'In Progress',
            self::SUBMITTED->value => 'Submitted',
            self::APPROVED->value => 'Approved',
            self::PAID->value => 'Paid'
        };
    }
}