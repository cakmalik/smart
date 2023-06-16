<?php

namespace App\Services;

use App\Models\BakidSetting;

class WhatsappService
{
    public function send($phone, $message = null)
    {
        // $apiKey = 'HXe9tuKu6mB7';
        $apiKey = BakidSetting::where('name', 'api_key_whatsapp')->first();
        $apiKey = $apiKey?->value;
        if (!$message) {
            $message = $this->admission();
        }
        $no = formatPhoneNumber($phone);
        try {
            $client = new \GuzzleHttp\Client();
            $url = 'http://api.textmebot.com/send.php?recipient=' . $no . '&apikey=' . $apiKey . '&text=' . $message . '&json=yes';
            $response = $client->request('GET', $url);
            return $response;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function checkConnection($phone, $message = null)
    {
        $apiKey = BakidSetting::where('name', 'api_key_whatsapp')->first();
        $apiKey = $apiKey?->value;
        if (!$message) {
            $message = $this->admission();
        }
        $no = formatPhoneNumber($phone);
        try {
            $client = new \GuzzleHttp\Client();
            $url = 'http://api.textmebot.com/send.php?recipient=' . $no . '&apikey=' . $apiKey . '&text=' . $message . '&json=yes';
            $response = $client->request('GET', $url);
            if ($response->getStatusCode() == 200) {
                $success = true;
                $pesan = 'Koneksi berhasil';
            } else {
                $success = false;
                $pesan = 'Koneksi gagal';
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            $success = false;
            $pesan = 'Terjadi kesalahan server';
        }
        return [
            'success' => $success,
            'message' => $pesan,
        ];
    }

    public function admission()
    {
        $pesan = 'Terima kasih telah melakukan pendaftaran di \nPondok Pesantren Miftahul Ulum Banyuputih Kidul';
        return $pesan;
        // urlencode($pesan);
    }

    public function newStudent()
    {
        return "Assalamualaikum wr.wb.\nBerikut rincian tagihan untuk pendaftaran ananda: \n*" . $transaction->customer_name . "*\n\n~~~~~~~~~~~\nNominal : *Rp. " . number_format($transaction->amount) . "*\nMelalui : " . $transaction->payment_name . "\nKode Pembayaran : *" . $transaction->pay_code . "*\nLakukan pembayaran sebelum : " . Carbon::createFromTimestamp($transaction->expired_time)->isoFormat('dddd, D MMMM Y, H:m') . "\n~~~~~~~~~~~\n\n_Wa ini dikirim otomatis, untuk informasi lebih lanjut hubungi kami di +6285216329458_\n\nwww.mubakid.or.id";
    }

    public function nota()
    {
        return
            "*NOTA ELEKTRONIK*\n$link\n\nTerima kasih telah melakukan pembayaran: \n*" . $nama . "*\n\n~~~~~~~~~~~~~~~\nNominal : *Rp. " . number_format($amount) . "*\nStatus : $status \n~~~~~~~~~~~~~~~\n\n_Wa ini dikirim otomatis, untuk informasi lebih lanjut hubungi kami di +6285216329458_\n\nwww.mubakid.or.id";
    }

    public function bill()
    {
        return "Assalamualaikum wr.wb.\nBerikut rincian tagihan untuk pendaftaran ananda: \n*" . $transaction->customer_name . "*\n\n~~~~~~~~~~~\nNominal : *Rp. " . number_format($transaction->amount) . "*\nMelalui : " . $transaction->payment_name . "\nKode Pembayaran : *" . $transaction->pay_code . "*\nLakukan pembayaran sebelum : " . Carbon::createFromTimestamp($transaction->expired_time)->isoFormat('dddd, D MMMM Y, H:m') . "\n~~~~~~~~~~~\n\n_Wa ini dikirim otomatis, untuk informasi lebih lanjut hubungi kami di +6285216329458_\n\nwww.mubakid.or.id";
    }
}
