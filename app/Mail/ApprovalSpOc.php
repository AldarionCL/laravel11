<?php

namespace App\Mail;

use App\Models\OrderRequest\OcOrderRequest;
use App\Models\OrderRequest\OrderRequest;
use App\Models\PurchaseOrder\Approval;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovalSpOc extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $name;
    public $id;
    public string $url;
    public $message;
    public $order;
    public $approved;
    public $comment;

    public function __construct( $name, $url, $id , $subject, $message, $order = null, $approved  = null, $comment = null)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->id = $id;
        $this->url = $url;
        $this->message = $message;
        $this->order = $order;
        $this->approved = $approved;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if ($this->approved) {
            $dataApproveals = Approval::where('ocOrderRequest_id', $this->order)->where('type', 2)->limit(2)->get();

            $arrayFiles = OrderRequest::where('order_id', $this->order)->select('request_id')->get()->toArray();

            $applicant = "";

            if ( $arrayFiles ) {
                $data = OcOrderRequest::find($arrayFiles[0]['request_id'])->load('recorder');
                $applicant = $data->recorder->Nombre;
            }

            $this->order->load('ocDetailPurchaseOrder.ocProduct');

            $pdfContent = PDF::loadView(
                'oc.document.despacho',
                [
                    'ocPurchaseOrder' => $this->order,
                    'ocDetailPurchaseOrder' => $this->order->ocDetailPurchaseOrder,
                    'date' => $dataApproveals->first()->updated_at,
                    'approver' => $dataApproveals,
                    'applicant' => $applicant
                ])->save(storage_path('app/public/') . "archivo{$this->id}.pdf");;



            return $this->from('roma@mailpompeyo.cl')
                ->subject($this->subject)
                ->attachFromStorage('/public/' . "archivo{$this->id}.pdf")
                ->markdown('emails.sp-oc.approval-sp-oc');
        }

        return $this->from('roma@mailpompeyo.cl')
            ->subject($this->subject)
            ->markdown('emails.sp-oc.approval-sp-oc');
    }

}
