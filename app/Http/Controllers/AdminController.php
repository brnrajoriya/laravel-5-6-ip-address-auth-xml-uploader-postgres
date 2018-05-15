<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\AccessIp;
use App\XMLData;
use App\Http\Requests\IpAddressRequest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use SimpleXMLElement;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('ip.auth');
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin');
    }

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ipList() {
        $ips = AccessIp::paginate(10);
        return view('ip.index', compact('ips'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeIp(IpAddressRequest $request) {
        AccessIp::create($request->all());
        return back()->with('status', 'IP has been added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteIp($id) {
        AccessIp::find($id)->delete();
        return back()->with('status', 'IP has been deleted successfully.');
    }

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function xmlList() {
        $xmls = XMLData::paginate(10);
        return view('xml.index', compact('xmls'));
    }

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function xmlRefresh() {
        $client = new Client();
        $xmls = [
            [
                'url' => 'https://www.designboom.com/feed/',
                'method' => 'GET'
            ],
            [
                'url' => 'https://worldarchitecture.org/feed/',
                'method' => 'GET'
            ],
        ];
        foreach ($xmls as $key => $xml) {
            $response = $client->request($xml['method'], $xml['url']);
            foreach ($this->parseResponse($response)->channel->item as $key => $item) {
                XMLData::firstOrCreate([
                    'title' => $item->title
                ],
                [
                    'link' => $item->link,
                    'description' => (string) $item->description
                ]);
            }
        }
        return back()->with('status', 'XMLs are refreshed successfully.');
    }

    protected function parseResponse($response) {
        return new SimpleXMLElement($response->getBody()->getContents());
    }
}
