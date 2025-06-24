<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserTypeEnum;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //Casts, Type -> UserTypeEnum
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'type' => UserTypeEnum::class,
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * @throws \Exception
     */
    public function canAccessPanel(Panel $panel): bool
        {
//            dd($this->type);
            if ($panel->getId() == 'admin' && $this->type == UserTypeEnum::Admin){
               return true;
              }


              if ($panel->getId() == 'company' && $this->type == UserTypeEnum::Company){
               return true;
             }


              return false;
        }


    public static function getForm(): array
    {
        $panel = Filament::getCurrentPanel();
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Select::make('roles')
                ->translateLabel()
                ->relationship('roles', 'name')
                ->preload()
                ->dehydrated(false)
                ->saveRelationshipsUsing(function (Model $record, $state) {
                    $record->roles()->sync($state);
                })
                ->searchable(),

            Select::make('type')
                ->dehydrated(true)
                ->visible(function (string $context) use ($panel): bool {
                    return $panel->getId() === 'admin';
                })
                ->enum(UserTypeEnum::class)
                ->options(UserTypeEnum::class)
                ->required(),

            TextInput::make('password')
                ->translateLabel()
                ->columnSpanFull()
                ->password()
                ->revealable()
                ->required()
                ->visibleOn(['create'])
                ->maxLength(255),

            Hidden::make('tenant_id')
                ->dehydrated(true)
                ->default(function (){

                    return auth()->user()->tenant_id;
                }),


        ];
    }
}
