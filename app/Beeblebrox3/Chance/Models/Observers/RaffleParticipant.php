<?php

namespace Beeblebrox3\Chance\Models\Observers;

class RaffleParticipant extends AbstractObserver
{
    protected $rules = array(
        'name' => 'required|max:64',
        'email' => 'required|email',
        'raffle_id' => 'required|exists:raffles,id',
    );

    /**
    * Pass the data and the rules to the validator
    *
    * @return boolean
    */
    public function passes(array $data, array $rules)
    {
        $validator = $this->validator->make($data, $rules);

        if ($validator->passes()) {
            // check if exists
            $exists = with(new \Beeblebrox3\Chance\Models\RaffleParticipant)->whereEmail($data['email'])
                ->where('raffle_id', '=', $data['raffle_id'])->first();
            if ($exists) {
                $this->errors = new \Illuminate\Support\MessageBag;
                $this->errors->add('email', \Lang::get('validation.email_duplicated'));
                return false;
            }
            return true;
        }

        $this->errors = $validator->messages();
        return false;
    }
}
