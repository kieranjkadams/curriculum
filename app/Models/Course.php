<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'courses';

    protected $primaryKey ='course_id';

    protected $fillable = ['course_code', 'course_num', 'course_title', 'program_id', 'status', 'assigned', 'type'];

    protected $guarded = ['course_id'];

    public function users(){
        return $this->belongsToMany(User::class, 'course_users', 'course_id', 'user_id');
    }

    public function learningActivities(){
        return $this->hasMany(LearningActivity::class, 'course_id','course_id');
    }

    public function assessmentMethods(){
        return $this->hasMany(AssessmentMethod::class, 'course_id','course_id');
    }

    public function learningOutcomes(){
        return $this->hasMany(LearningOutcome::class, 'course_id','course_id');
    }

    public function program() 
    {
        return $this->belongsToMany(Program::class, 'course_programs', 'course_id', 'program_id');
    }

    public function msScaleCategories() {
        return $this->belongsTo(MSScaleCategory::class, 'ms_scale_category_id', 'ms_scale_category_id');
    }

    public function ministryStandardCategory() {
        return $this->belongsTo(MinistryStandardCategory::class, 'msc_id', 'msc_id');
    }
}


