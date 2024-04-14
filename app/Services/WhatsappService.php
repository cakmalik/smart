<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\BakidSetting;
use App\Models\FormatMessage;
use App\Jobs\JobReminderAdmission;
use App\Jobs\JobSendWhatsappMessage;
use Illuminate\Support\Facades\Log;
use App\Jobs\JobSendWhatsappReminder;

class WhatsappService
{
    public function sendReminder($phone, $message = null)
    {
        Log::info('run: WhatsappService here');
        $apiKey = BakidSetting::where('name', 'api_key_whatsapp')->first();
        $apiKey = $apiKey?->value;
        if (!$message) {
            $message = $this->admission();
        }
        $no = formatPhoneNumber($phone);
        // Log::info('run: WhatsappService here 2');
        try {
            $client = new \GuzzleHttp\Client();
            $url = 'http://api.textmebot.com/send.php?recipient=' . $no . '&apikey=' . $apiKey . '&text=' . $message . '&json=yes';
            Log::info('run: WhatsappService url:' . $url);
            $response = $client->request('GET', $url);
            $response = json_decode($response->getBody()->getContents());
            Log::info(json_encode($response) . ' ' . $phone);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
    public function send($phone, $message = null)
    {
        // $apiKey = 'HXe9tuKu6mB7';
        Log::info('run: WhatsappService here');
        $apiKey = BakidSetting::where('name', 'api_key_whatsapp')->first();
        $apiKey = $apiKey?->value;
        if (!$message) {
            $message = $this->admission();
        }
        $no = formatPhoneNumber($phone);
        // Log::info('run: WhatsappService here 2');
        try {
            $client = new \GuzzleHttp\Client();
            $url = 'http://api.textmebot.com/send.php?recipient=' . $no . '&apikey=' . $apiKey . '&text=' . $message . '&json=yes';
            Log::info('run: WhatsappService url:' . $url);
            $response = $client->request('GET', $url);
            $response = json_decode($response->getBody()->getContents());
            Log::info(json_encode($response) . ' ' . $phone);
            // if ($response->getStatusCode() == 200) {
            //     $success = true;
            //     $pesan = 'Koneksi berhasil';
            // } elseif ($response->status == 'error') {
            //     $success = false;
            //     $pesan = $response->comment;
            // } else {
            //     $success = false;
            //     $pesan = 'Koneksi gagal';
            // }
            // Log::info('run: WhatsappService here 3');
            // Log::info('run: WhatsappService here 4 sukses: ' . $pesan);
            // return $response;
            // Log::info('run: End WhatsappService');
        } catch (\Exception $e) {
            return $e->getMessage();
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
    public function sendMessage($phone, $message = null)
    {
        // $apiKey = 'HXe9tuKu6mB7';
        Log::info('run: WhatsappService here');
        $apiKey = BakidSetting::where('name', 'api_key_whatsapp')->first();
        $apiKey = $apiKey?->value;
        if (!$message) {
            $message = $this->admission();
        }
        $no = formatPhoneNumber($phone);
        // Log::info('run: WhatsappService here 2');
        try {
            $client = new \GuzzleHttp\Client();
            $url = 'http://api.textmebot.com/send.php?recipient=' . $no . '&apikey=' . $apiKey . '&text=' . $message . '&json=yes';
            Log::info('run: WhatsappService url:' . $url);
            $response = $client->request('GET', $url);
            $response = json_decode($response->getBody()->getContents());
            Log::info(json_encode($response) . ' ' . $phone);
        } catch (\Exception $e) {
            return $e->getMessage();
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
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
        return "Assalamualaikum wr.wb.\nBerikut rincian tagihan untuk pendaftaran ananda: \n*" . $transaction->customer_name . "*\n\n~~~~~~~~~~~\nNominal : *Rp. " . number_format($transaction->amount) . "*\nMelalui : " . $transaction->payment_name . "\nKode Pembayaran : *" . $transaction->pay_code . "*\nLakukan pembayaran sebelum :\n" . Carbon::createFromTimestamp($transaction->expired_time)->isoFormat('dddd, D MMMM Y, H:m') . "\n~~~~~~~~~~~\n\n_Wa ini dikirim otomatis, untuk informasi lebih lanjut hubungi kami di +6285216329458_\nbakid.id";
    }

    public function nota()
    {
        return "*NOTA ELEKTRONIK*\n$link\n\nTerima kasih telah melakukan pembayaran: \n*" . $nama . "*\n\n~~~~~~~~~~~~~~~\nNominal : *Rp. " . number_format($amount) . "*\nStatus : $status \n~~~~~~~~~~~~~~~\n\n_Wa ini dikirim otomatis, untuk informasi lebih lanjut hubungi kami di +6285216329458_\n bakid.id";
    }

    public function sendInvoice($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();
        if (!$invoice) {
            Log::info('invoice not found');
            return;
        }
        $message = "Assalamualaikum wr.wb.\nBerikut rincian tagihan pembayaran: \n*" . $invoice->student?->name . "*\n\n~~~~~~~~~~~\nNominal : *Rp. " . number_format($invoice->final_amount) . "*\nMelalui : " . $invoice->method->name . "\nKode Pembayaran : *" . $invoice->invoice_number . "*\nLakukan pembayaran sebelum :\n" . Carbon::parse($invoice->due_date)->isoFormat('dddd, D MMMM Y, H:m') . "\n~~~~~~~~~~~\n\n_Wa ini dikirim otomatis, untuk informasi lebih lanjut hubungi kami di +6285216329458_\nbakid.id";

        if ($invoice->student->phone != '-') {
            JobSendWhatsappMessage::dispatch($invoice->student->phone, $message);
        }
        JobSendWhatsappMessage::dispatch($invoice->user->phone, $message);
    }

    function tesMessage(string $type = 'reminder_registration'): bool
    {
        try {
            $message = FormatMessage::where('name', $type)->first()->message;

            // placeholder
            $namaOrtu = '#nama_ortu';
            $enter = PHP_EOL;
            $placeholders = ['#nama_ortu', '#enter'];
            $values = [$namaOrtu, $enter];

            // formatted + to url
            $pesanFormatted = formatMessage($message, $placeholders, $values);
            $message = urlencode($pesanFormatted);

            $send = new JobSendWhatsappReminder('085333920007', $message);
            dispatch($send);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}