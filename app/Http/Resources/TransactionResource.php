<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'effected_at' => $this->effected_at->format('Y-m-d'),
            'label' => $this->label,
            'debit_account_name' => $this->debitAccount->name,
            'credit_account_name' => $this->creditAccount->name,
            'amount' => $this->amount,
        ];
    }
}
