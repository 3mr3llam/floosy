<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case Pending = 'pending';
    case Suspended = 'suspended';
    case Scheduled = 'scheduled';
    case Overdue = 'overdue';
    case Paid = 'paid';
    case NotReceived = 'not_received';
}
