<?php

namespace App\Models\WebSocket;

use BeyondCode\LaravelWebSockets\Statistics\Models\WebSocketsStatisticsEntry;

class WebSocketsStatistics extends WebSocketsStatisticsEntry
{
    protected $table = 'WS_statistics_entries';
}
