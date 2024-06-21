<?php

namespace App\Filament\Resources\AgentResource\Pages;

use App\Filament\Resources\AgentResource;
use App\Mail\AgentWelcomeEmail;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateAgent extends CreateRecord
{
    protected static string $resource = AgentResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

        Mail::to($data['email'])->send(new AgentWelcomeEmail($data['name']));

        return $data;
    }
}
