<?php

namespace App\Filament\Resources\AgentResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\AgentResource;
use App\Mail\AgentApprovedEmail;
use Illuminate\Support\Facades\Mail;

class EditAgent extends EditRecord
{
    protected static string $resource = AgentResource::class;


    protected function mutateFormDataBeforeFill(array $data): array
    {

        if ($data['status'] == 'publish') {

            Mail::to($data['email'])->send(new AgentApprovedEmail($data['name']));
        }

        return $data;
    }
}
