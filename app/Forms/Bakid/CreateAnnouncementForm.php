<?php

namespace App\Forms\Bakid;

use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\File;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Datetime;
use ProtoneMedia\Splade\FormBuilder\Textarea;

class CreateAnnouncementForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('announcement.store'))
            ->method('POST')
            ->class('space-y-4 p-4');
    }

    public function fields(): array
    {
        return [
            Input::make('title')->label(__('title'))->rules('required')->class('capitalize'),
            Textarea::make('body')->label(__('content'))->rules('required')->class('capitalize'),
            Datetime::make('start_show')->label(__('start'))->rules('required')->class('capitalize'),
            Datetime::make('end_show')->label(__('end'))->rules('required')->class('capitalize'),
            File::make('image')->server()->preview()->maxSize('2Mb')->label(__('image'))->class('capitalize')->rules(['nullable', 'mimes:png,jpg']),
            Submit::make()->label(__('create'))->class('capitalize')
        ];
    }
}
