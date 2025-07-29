<?php

namespace App\Console\Commands;

use App\Services\StockNotificationService;
use Illuminate\Console\Command;

class VerificarStockProductos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:verificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar el stock de productos y enviar notificaciones al administrador';

    protected $stockNotificationService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StockNotificationService $stockNotificationService)
    {
        parent::__construct();
        $this->stockNotificationService = $stockNotificationService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Verificando stock de productos...');

        try {
            $this->stockNotificationService->verificarStockProductos();
            
            $this->info('Verificación de stock completada. Notificaciones enviadas si es necesario.');
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Error al verificar stock: ' . $e->getMessage());
            return 1;
        }
    }
} 