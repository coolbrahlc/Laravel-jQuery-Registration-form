<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

/**
 * App\People
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string|null $birth
 * @property string|null $country
 * @property string|null $subject
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $hidden
 * @property string|null $photo
 * @property string|null $about
 * @property string|null $company
 * @property string|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People whereUpdatedAt($value)
 */
class People extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'birth',
        'country',
        'subject',
        'email',
        'phone',
        'hidden',
        'photo',
        'about',
        'company',
        'position'
    ];

    public function getPeople()
    {

        if(Auth::user())
        {
            return People::paginate(7);
        } else {

            return People::whereHidden( '0')->paginate(7);
        }
    }
}