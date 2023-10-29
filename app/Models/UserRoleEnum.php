<?php

namespace App\Models;

enum UserRoleEnum: string
{
    case SELLER = "продавец";
    case BUYER = "покупатель";

}
