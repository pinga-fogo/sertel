<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class attr_avanc_khomp extends Model
{
    
    protected $table = 'attr_avanc_khomp';

    protected $fillable = [
            'id',
            'ccss_enable',
            'audio_rx_sync',
            'context_gsm_call',
            'context_gsm_sms',
            'volume_tx', 
            'volume_rx', 
            'suprimir_id',
            'block_call',
            'disconnect_call', 
            'co_dialtone',
            'vm_dialtone', 
            'pbx_dialtone', 
            'fast_busy',
            'ring_back',
            'waiting_call',
            'ring',
            'context_digital',
            'language',
            'mohclass',
            'flash_behaviour',
            'pendulum_digits',
            'pendulum_hu_digits',
            'context_fxo',
            'context_fxo_alt',
            'fxo_fsk_detection',
            'fxo_fsk_timeout',
            'fxo_user_xfer_delay',
            'fxo_send_pre_audio',
            'fxo_busy_disconnection',
     ];

 }
