<?php
namespace App\Services\Payment\Invoice;

use App\Models\Order;
use ConsoleTVs\Invoices\Classes\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;

class InvoiceService
{
    /**
     * @param array $items
     * @param int $invoiceNo
     * @return Invoice
     */
    public static function createInvoice(array $items, int $invoiceNo): Invoice
    {
        return self::generateInvoice($items, $invoiceNo, Auth::id());
    }

    /**
     * @param array $items
     * @param int $invoiceNo
     * @param int $userId
     * @return Invoice
     */
    public static function generateInvoice(array $items, ?int $invoiceNo, int $userId):Invoice
    {
        $user = User::find($userId);
        $invoice = Invoice::make();
        foreach ($items as $item){
            $invoice->addItem(
                $item["Name"],
                $item["Price"],
                $item["Quantity"],
                $item["Id"],
            );
        }
        if($invoiceNo == '' || $invoiceNo == 0){
            $invoiceNo = 'Proforma invoice';
        }

        $invoice->number($invoiceNo)
            ->with_pagination(true)
            ->duplicate_header(true)
            ->due_date(Carbon::now()->addMonths(1))
            ->currency('GBP')
            ->notes('Lrem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->customer([
                'name'      => $user->name,
                'id'        => '12345678A',
                'phone'     => '+34 123 456 789',
                'location'  => 'C / Unknown Street 1st',
                'zip'       => '08241',
                'city'      => 'Manresa',
                'country'   => 'Spain',
            ])
            ->download('invoice-' . $invoiceNo .'pdf')
            //or save it somewhere
            ->save('public/invoice-' . $invoiceNo .'pdf');

        return $invoice;
    }
}
