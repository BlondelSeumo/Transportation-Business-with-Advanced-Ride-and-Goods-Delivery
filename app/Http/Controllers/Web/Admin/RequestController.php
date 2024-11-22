<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Admin\RequestFilter;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Controller;
use App\Models\Cms\FrontPage;
use App\Models\Request\Request as RequestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\LocaleException;



class RequestController extends Controller
{
    public function index()
    {
        $page = trans('pages_names.request');
        $main_menu = 'trip-request';
        $sub_menu = 'request';

        return view('admin.request.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function indexDelivery()
    {
        $page = trans('pages_names.delivery_request');
        $main_menu = 'delivery-trip-request';
        $sub_menu = 'delivery-request';

        return view('admin.delivery_request.index', compact('page', 'main_menu', 'sub_menu'));
    }


    public function getAllRequest(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');
       
        $query = RequestRequest::companyKey()->where('transport_type','taxi');

        if($app_for=='taxi')
        {
        
        $query = RequestRequest::companyKey();

        }


        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.request._request', compact('results'));
    }

    public function getAllDeliveryRequest(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');
       
        $query = RequestRequest::companyKey()->where('transport_type','delivery');

        if($app_for=='delivery')
        {
        
        $query = RequestRequest::companyKey();

        }

        // dd($app_for);
        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.delivery_request._request', compact('results','app_for'));
    }

    public function retrieveSingleRequest(RequestRequest $request){
        $item = $request;

        return view('admin.request._singlerequest', compact('item'));
    }

    public function getSingleRequest(RequestRequest $request)
    {
        $page = trans('pages_names.request');
        $main_menu = 'trip-request';
        $sub_menu = 'request';

        $item = $request;
        $data = $request;

        return view('admin.request.requestview', compact('page', 'main_menu', 'sub_menu', 'item','data'));
    }
    public function getSingleRequestOpen(RequestRequest $request)
    {
        $page = trans('pages_names.request');
        $main_menu = 'trip-request';
        $sub_menu = 'request';

        $item = $request;

        return view('admin.request.requestviewopen', compact('page', 'main_menu', 'sub_menu', 'item'));
    }

    public function fetchSingleRequest(RequestRequest $request){
        return $request;
    }

     public function requestDetailedView(RequestRequest $request){
        $item = $request;
        $page = trans('pages_names.request');
         $main_menu = 'trip-request';
        $sub_menu = 'request';

        return view('admin.request.trip-request',compact('item','page', 'main_menu', 'sub_menu'));
    }
    public function requestDetailedViewOpen(RequestRequest $request){
        $item = $request;
        $page = trans('pages_names.request');
         $main_menu = 'trip-request';
        $sub_menu = 'request';

        return view('admin.request.trip-request-open',compact('item','page', 'main_menu', 'sub_menu'));
    }

     public function indexScheduled()
    {
        $page = trans('pages_names.request');
        $main_menu = 'trip-request';
        $sub_menu = 'scheduled-rides';

        return view('admin.scheduled-rides.index', compact('page', 'main_menu', 'sub_menu'));
    }


    public function indexScheduledDelivery()
    {
        $page = trans('pages_names.delivery_request');
        $main_menu = 'delivery-trip-request';
        $sub_menu = 'scheduled-rides';

        return view('admin.scheduled-delivery-rides.index', compact('page', 'main_menu', 'sub_menu'));
    }

     public function getAllScheduledRequest(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');

        $query = RequestRequest::companyKey()->where('transport_type','taxi')->whereIsCompleted(false)->whereIsCancelled(false)->whereIsLater(true);

        if($app_for=='taxi')
        {
        $query = RequestRequest::companyKey()->whereIsCompleted(false)->whereIsCancelled(false)->whereIsLater(true);
        }

        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.scheduled-rides._scheduled', compact('results'));
    }

    public function getAllScheduledDeliveryRequest(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');

        $query = RequestRequest::companyKey()->where('transport_type','delivery')->whereIsCompleted(false)->whereIsCancelled(false)->whereIsLater(true);


        if($app_for=='delivery')
        {
        $query = RequestRequest::companyKey()->whereIsCompleted(false)->whereIsCancelled(false)->whereIsLater(true);
        }

        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.scheduled-delivery-rides._scheduled', compact('results'));
    }

    /**
     * View Invoice
     *
     * */
    public function viewCustomerInvoice(RequestRequest $request_detail){

        $data = $request_detail;

        return view('email.invoice',compact('data'));

    }
    public function viewCustomerInvoiceDirect(RequestRequest $request_detail){

        $data = $request_detail;
        $count = $data->requestStops->count();
        $links=FrontPage::first();

        //dd($data,$data->RequestBill,$data->requestStops);
        return view('email.customer_invoice_direct',compact('data','links'));

    }
    /**
     * View Invoice
     *
     * */
    public function viewDriverInvoice(RequestRequest $request_detail){
        $data = $request_detail;

        return view('email.driver_invoice',compact('data'));

    }
    public function viewDriverInvoiceDirect(RequestRequest $request_detail)
{
    $data = $request_detail;
   // dd($data,$data->RequestBill);
   $links=FrontPage::first();

    return view('email.driver_invoice_direct',compact('data','links'));
}
public function viewDriverInvoiceDirectPost(RequestRequest $request_detail)
{
    $data = $request_detail;

    return view('email.driver_invoice_direct',compact('data'));
}

public function getCancelledRequest(RequestRequest $request)
    {
        $page = trans('pages_names.request');
        $main_menu = 'cancelled-request';
        $sub_menu = 'request';

        $item = $request;
        // dd($item->cancelReason);

        return view('admin.request.Cancelledview', compact('page', 'main_menu', 'sub_menu', 'item'));
    }


    public function indexOutStation()
    {
        $page = trans('pages_names.request');
        $main_menu = 'trip-request';
        $sub_menu = 'out-station-rides';

        return view('admin.out-station-rides.index', compact('page', 'main_menu', 'sub_menu'));
    }
    public function getAllOutStationRequest(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');
        
        $query = RequestRequest::companyKey()->where('transport_type','taxi')->whereIsCompleted(false)->whereIsCancelled(false)->whereIsOutstation(true);


        if($app_for=='taxi')
        {
        $query = RequestRequest::companyKey()->whereIsCompleted(false)->whereIsCancelled(false)->whereIsOutstation(true);
        }

        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.scheduled-rides._scheduled', compact('results'));
    }
    public function EmailCustomerIvoiceDirect(RequestRequest $request_detail)
    {


        $data=$request_detail;



        $links = FrontPage::first();
        $start = '1';


        return view('email.email_customer_invoice', compact('data', 'links', 'start'));
    }
    public function EmailCustomerIvoiceDirect1(RequestRequest $request_detail,$id)
    {


        $data=RequestRequest::where('id',$id)->first();



        $links = FrontPage::first();
        $start = '1';


        return view('email.email_customer_invoice', compact('data', 'links', 'start'));
    }
    public function savePdf(Request $request)
    {
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfPath = $pdf->storeAs('pdfs', 'document.pdf', 'public');

            return response()->json(['path' => $pdfPath]);
        }

        return response()->json(['message' => 'No PDF received'], 400);
    }

    public function sendEmail(Request $request)
    {
        $pdfPath = $request->input('pdfPath');

        // Your email sending logic here
        // For example, if you're using Laravel's built-in mail functionality:
        \Mail::send([], [], function($message) use ($pdfPath) {
            $message->to('recipient@example.com')
                    ->subject('Invoice')
                    ->attach(public_path($pdfPath));
        });

        return response()->json(['message' => 'Email sent successfully']);
    }

    private function generatePDF()
    {
        // This method handles client-side PDF generation, so there's no need for server-side generation
        return null;
    }


}
