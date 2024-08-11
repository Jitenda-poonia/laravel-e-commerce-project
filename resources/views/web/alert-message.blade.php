@if(session()->has('success'))
<p style="background: #FFD333;
padding: 15px;
color: #000;
font-weight: 500;">{{ session()->get('success') }}</p>
@elseif(session()->has('error'))
<p
    style="background: #FFD333;
padding: 15px;
color: #FF0000;
font-weight: 500;">
    {{ session()->get('error') }}</p>
@endif

