<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalData extends Model
{
    //
    protected $fillable = ["website_name", "website_logo", "contact_numbers", "contact_email", "address", "about_us"];
}
