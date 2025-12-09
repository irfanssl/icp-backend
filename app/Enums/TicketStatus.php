<?php

namespace App\Enums;

enum TicketStatus{
    case OPEN;
    case IN_PROGRESS;
    case SOLVED;
    case CLOSED;
}