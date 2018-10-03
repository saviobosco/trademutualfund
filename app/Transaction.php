<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Transaction extends Model
{
    CONST CONFIRMED = 2;
    CONST CANCELLED = -1;
    CONST ACTIVE = 1;

    protected $guarded = ['id'];

    public function make_payment_user()
    {
        return $this->belongsTo(User::class, 'make_payment_user_id', 'id');
    }

    public function get_payment_user()
    {
        return $this->belongsTo(User::class, 'get_payment_user_id', 'id');
    }

    public function get_payment()
    {
        return $this->belongsTo(GetPayment::class);
    }

    public function make_payment()
    {
        return $this->belongsTo(MakePayment::class);
    }

    public function photo_proofs()
    {
        return $this->hasMany(PhotoProof::class);
    }

    public function transaction_reports()
    {
        return $this->hasMany(TransactionReport::class);
    }

    public function addImageProof($image)
    {
        return $this->photo_proofs()->create($image);
    }

    public function removeImageProof($image_id)
    {
        $photo = PhotoProof::find($image_id);
        $photo->delete();
        $storage = null;
        $env = env('FILESYSTEM_DRIVER');
        if ($env === 'local') {
            Storage::delete('public/images/'.$photo['photo_name']);
        } elseif ($env === 'cloud') {
            Storage::disk('s3')->delete($photo['photo_url_part'].'/'.$photo['photo_name']);
        }
        return $photo;
    }

    public function confirm()
    {
        if ($this->isActive() === false) {
            return false;
        }
        if ($makePayment = $this->make_payment()->first()) {
            $makePayment->updateAmountPaid(['amount_paid' => $this->amount]);
        }
        if ($getPayment = $this->get_payment()->first()) {
            $getPayment->updateAmountPaid(['amount_paid' => $this->amount]);
        }
        $this->resolveReports();
        return $this->update([
            'status' => static::CONFIRMED,
            'confirmed_at' => new Carbon()
        ]);
    }

    public function reportFakeProofOfPayment($report)
    {
        return $this->transaction_reports()->create($report);
    }

    public function resolveReports()
    {
        $reports = $this->transaction_reports()->get();
        if (count($reports)) {
            foreach($reports as $report) {
                $report->resolved();
            }
        }
        return true;
    }

    public function cancel()
    {
        if ($this->isActive()) {
            if ($getPayment = $this->get_payment()->first()) {
                $getPayment->amount += $this->amount;
                $getPayment->status = GetPayment::STATUS_ACTIVE;
                $getPayment->update();
            }
            return $this->update(['status' => static::CANCELLED]);
        }
        return false;
    }

    public function isCancelled()
    {
        return (int)$this->status === static::CANCELLED;
    }

    public function isConfirmed()
    {
        return (int)$this->status === static::CONFIRMED;
    }

    public function isActive()
    {
        return (int)$this->status === static::ACTIVE;
    }

    public function getTimeElapseAfterAttribute($date)
    {
        return (new Carbon($date))->toAtomString();
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('c');
    }

    public function resetTimer()
    {
        return $this->update(['time_elapse_after' => new Carbon('+12 hours')]);
    }
}
