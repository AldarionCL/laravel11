<?php

namespace App\Http\Livewire\Maintainer;

use App\Models\Roma\BranchOffice;
use App\Models\Roma\Position;
use App\Models\Roma\UserBranch;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class FormAssignmentBranchOfficeForUser extends Component
{
    public $user_id;
    public $branchesAssignedToUser = [];
    public $position;

    public function mount( $user_id ): void
    {
        $this->user_id = $user_id;
    }

    public function render(): Renderable
    {
        return view('livewire.maintainer.form-assignment-branch-office-for-user',
            [
                'user' => User::find($this->user_id),
            ]
        );
    }
}
