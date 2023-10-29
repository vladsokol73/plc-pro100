<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class ContactModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.contact-modal');
    }
}
