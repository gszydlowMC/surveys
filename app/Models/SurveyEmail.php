<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveyEmail extends Model
{
    use Sortable;

    protected $table = 'survey_emails';


}

