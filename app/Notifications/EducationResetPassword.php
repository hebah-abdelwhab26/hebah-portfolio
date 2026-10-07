<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;

class EducationResetPassword extends ResetPassword
{
    /**
     * Build the reset password URL for Education users.
     */
    protected function resetUrl($notifiable)
    {
        return url(route('education.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}