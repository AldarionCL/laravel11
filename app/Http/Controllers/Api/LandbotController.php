<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageLandbotEvent;
use App\Events\SendMessageLandbotEvent;
use App\Http\Controllers\Controller;
use App\Models\Landbot\Chat;
use App\Models\Landbot\ChatUsed;
use App\Models\Landbot\Message;
use App\Models\Landbot\MessageUsed;
use App\Models\Ticket\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LandbotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_Category_C
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ( $request->header('Authorization') !== config('auth.token_landbot')  ){
            return response()->json(['message' => 'Unauthorized'], 401 );
        }

        // 1706179 Nuevos
        // 1401008 Usados

        if ( $request->input('messages.0.channel.id') === 1401008 ){
            $this->leadNew($request);
        }elseif ( $request->input('messages.0.channel.id') === 1706179){
            $this->leadUsed($request);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }

    public function leadNew(Request $request)
    {
        DB::transaction( function () use ( $request ) {
            $chat = Chat::updateOrCreate(
                ['customer_id' => $request->input('messages.0.customer.id') ],
                [
                    'chat' => $request->input('messages.0._raw.chat'),
                    'channel' => $request->input('messages.0._raw.channel'),
                    'name_customer' => $request->input('messages.0.customer.name'),
                    'attention' => $request->input('messages.0.customer.atencion'),
                    'brand' => $request->input('messages.0.customer.marca'),
                    'model' => $request->input('messages.0.customer.modelo'),
                    'phone' => $request->input('messages.0.customer.phone'),
                ]
            );

            if ($request->has( [ 'messages.0.customer.atencion', 'messages.0.customer.marca', 'messages.0.customer.modelo', 'messages.0.customer.phone']) && $request->input('messages.0.customer.atencion' ) === 'nuevos') {

                $branch = match ($request->input('messages.0.customer.marca')) {
                    "DFSK" => 'DFSK Mall Plaza Oeste',
                    "Geely" => 'GEELY_VIRTUAL',
                    "Kia" => 'KIA_VIRTUAL',
                    "Mg" => 'MG_VIRTUAL',
                    "Nissan" => 'Nissan_Virtual',
                    "Opel" => 'OPEL_VIRTUAL_MOVICENTER',
                    "Peugeot" => 'Peugeot Mall Arauco Maipu',
                    "Subaru" => 'Subaru Mall Plaza Oeste',
                };

                if ( $chat->lead_id === null || $request->input('messages.0.data.body') == "Gracias {$request->input('messages.0.customer.name')} , pronto un ejecutivo se pondra en contacto" ){

                    $seller = wsLandbotLeadsModelo(
                        $branch,
                        $request->input('messages.0.customer.modelo'),
                        'WHATSAPP',
                        '',
                        "{$request->input('messages.0.customer.name')}",
                        $request->input('messages.0.customer.phone'),
                        '',
                        $chat->id,
                    );

                    $dataLead = collect($seller);

                    Chat::where('customer_id', $request->input('messages.0.customer.id')  )
                        ->update( [
                            'seller_id' => $dataLead->value( 'Vendedor' ),
                            'lead_id' => $dataLead->value( 'IDLeads' )
                        ] );

                    event( new MessageLandbotEvent("Esta funcionando", $dataLead->value( 'Vendedor' )));
                }

            }elseif( $request->has( [ 'messages.0.customer.atencion', 'messages.0.customer.phone']) && $request->input('messages.0.customer.atencion' ) === 'Usados')
            {
                $seller = wsLandbotLeadsModelo(
                    '',
                    "{$request->input('messages.0.customer.modelousados')}",
                    'WHATSAPP',
                    '',
                    "{$request->input('messages.0.customer.name')}",
                    $request->input('messages.0.customer.phone'),
                    '',
                    $chat->id,
                );

                $dataLead = collect($seller);

                ChatUsed::where('customer_id', $request->input('messages.0.customer.id')  )
                    ->update( [
                        'seller_id' => $dataLead->value( 'Vendedor' ),
                        'lead_id' => $dataLead->value( 'IDLeads' )
                    ] );

                event( new MessageLandbotEvent("Esta funcionando", $dataLead->value( 'Vendedor' )));
            }

            Message::create([
                'customer_id' => $request->input('messages.0.customer.id'),
                'author_type' => $request->input('messages.0._raw.author_type'),
                'message' => $request->input('messages'),
                'read' => $request->input('messages.0._raw.read'),
                'file' => $request->input('messages.0._raw.type') === 'image' || $request->input('messages.0._raw.type') === 'audio' || $request->input('messages.0._raw.type') === 'document',
                'readed_at' => Carbon::createFromTimestamp($request->input('messages.0._raw.readed_at'))->toDateTimeString(),
            ]);

            event( new SendMessageLandbotEvent());
        });

        return response()->json(['message' => 'Recibido'], 201 );
    }

    public function leadUsed(Request $request)
    {
//        llegar teléfono, nombre y sucursal

        DB::transaction( function () use ( $request ) {
            $chat = ChatUsed::updateOrCreate(
                ['customer_id' => $request->input('messages.0.customer.id') ],
                [
                    'chat' => $request->input('messages.0._raw.chat'),
                    'channel' => $request->input('messages.0._raw.channel'),
                    'name_customer' => $request->input('messages.0.customer.name'),
                    'attention' => $request->input('messages.0.customer.atencion'),
                    'brand' => $request->input('messages.0.customer.marca'),
                    'model' => $request->input('messages.0.customer.modelo'),
                    'phone' => $request->input('messages.0.customer.phone'),
                ]
            );

            if ($request->has( ['messages.0.customer.name', 'messages.0.customer.phone', 'messages.0.customer.sucursal_usado'])) {


                if ( $chat->lead_id === null || $request->input('messages.0.data.body')){

                    $seller = wsLandbotLeadsModelo(
                        $request->input('messages.0.customer.sucursal_usado'),
                        '',
                        'WHATSAPP',
                        '',
                        "{$request->input('messages.0.customer.name')}",
                        $request->input('messages.0.customer.phone'),
                        '',
                        $chat->id,
                    );

                    $dataLead = collect($seller);

                    ChatUsed::where('customer_id', $request->input('messages.0.customer.id')  )
                        ->update( [
                            'seller_id' => $dataLead->value( 'Vendedor' ),
                            'lead_id' => $dataLead->value( 'IDLeads' )
                        ] );

                    event( new MessageLandbotEvent("Esta funcionando", $dataLead->value( 'Vendedor' )));
                }

            }

            MessageUsed::create([
                'customer_id' => $request->input('messages.0.customer.id'),
                'author_type' => $request->input('messages.0._raw.author_type'),
                'message' => $request->input('messages'),
                'read' => $request->input('messages.0._raw.read'),
                'readed_at' => Carbon::createFromTimestamp($request->input('messages.0._raw.readed_at'))->toDateTimeString(),
            ]);

            event( new SendMessageLandbotEvent());
        });

        return response()->json(['message' => 'Recibido'], 201 );
    }
}
