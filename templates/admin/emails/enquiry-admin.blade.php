<p>A new enquiry for model {{ $enquiry->model->public_name }} name was received</p>
<p>From name: {{ $enquiry->from_name }}</p>
<p>From company: {{ $enquiry->from_company }}</p>
<p>From email: {{ $enquiry->from_email }}</p>
<p>From mobile: {{ $enquiry->from_mobile }}</p>
<p>From IP: {{ $enquiry->from_ip }}</p>
<p>From Geo Country: {{ $enquiry->country->name }}</p>
<p>Message:</p>
<p>{{ $enquiry->message }}</p>
