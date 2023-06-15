@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection
<style>
  .error{
    color:red;
  }
</style>
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light"> Settings /</span> Setting
</h4>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Setting Details</h5>
      <!-- Account -->
      <form id="formAccountSettings" action="{{ENV('APP_URL')}}/addupdatesetting" method="post"   onsubmit="return checkvalidate()" enctype="multipart/form-data">
      @empty($tableData[0])
      @csrf
      <div class="card-body">
        <input type="hidden" name="userid" id="userid" value="" />
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{ENV('APP_URL')}}/users/sitelogo/" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload Site Logo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" name="photo" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
           
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="siteTitle" class="form-label">Site Title</label>
              <input class="form-control" type="text" id="siteTitle" name="siteTitle" value="" autofocus />
            </div>
            <div class="mb-3 col-md-6">
                    <label for="currency" class="form-label">Currency</label>
                    <select id="currency" name="currency" class="form-select"  aria-label="Default select example">
                    <option value="0">Select currency</option>
                    <option value="AFN">Afghan Afghani (AFN)</option>
                    <option value="ALL">Albanian Lek (ALL)</option>
                    <option value="DZD">Algerian Dinar (DZD)</option>
                    <option value="AOA">Angolan Kwanza (AOA)</option>
                    <option value="ARS">Argentine Peso (ARS)</option>
                    <option value="AMD">Armenian Dram (AMD)</option>
                    <option value="AWG">Aruban Florin (AWG)</option>
                    <option value="AUD">Australian Dollar (AUD)</option>
                    <option value="AZN">Azerbaijani Manat (AZN)</option>
                    <option value="BSD">Bahamian Dollar (BSD)</option>
                    <option value="BHD">Bahraini Dinar (BHD)</option>
                    <option value="BDT">Bangladeshi Taka (BDT)</option>
                    <option value="BBD">Barbadian Dollar (BBD)</option>
                    <option value="BYR">Belarusian Ruble (BYR)</option>
                    <option value="BEF">Belgian Franc (BEF)</option>
                    <option value="BZD">Belize Dollar (BZD)</option>
                    <option value="BMD">Bermudan Dollar (BMD)</option>
                    <option value="BTN">Bhutanese Ngultrum (BTN)</option>
                    <option value="BOB">Bolivian Boliviano (BOB)</option>
                    <option value="BAM">Bosnia-Herzegovina Convertible Mark (BAM)</option>
                    <option value="BWP">Botswanan Pula (BWP)</option>
                    <option value="BRL">Brazilian Real (BRL)</option>
                    <option value="GBP">British Pound Sterling (GBP)</option>
                    <option value="BND">Brunei Dollar (BND)</option>
                    <option value="BGN">Bulgarian Lev (BGN)</option>
                    <option value="BIF">Burundian Franc (BIF)</option>
                    <option value="KHR">Cambodian Riel (KHR)</option>
                    <option value="CAD">Canadian Dollar (CAD)</option>
                    <option value="CVE">Cape Verdean Escudo (CVE)</option>
                    <option value="KYD">Cayman Islands Dollar (KYD)</option>
                    <option value="XOF">CFA Franc BCEAO (XOF)</option>
                    <option value="XAF">CFA Franc BEAC (XAF)</option>
                    <option value="XPF">CFP Franc (XPF)</option>
                    <option value="CLP">Chilean Peso (CLP)</option>
                    <option value="CNY">Chinese Yuan (CNY)</option>
                    <option value="COP">Colombian Peso (COP)</option>
                    <option value="KMF">Comorian Franc (KMF)</option>
                    <option value="CDF">Congolese Franc (CDF)</option>
                    <option value="CRC">Costa Rican ColÃ³n (CRC)</option>
                    <option value="HRK">Croatian Kuna (HRK)</option>
                    <option value="CUC">Cuban Convertible Peso (CUC)</option>
                    <option value="CZK">Czech Republic Koruna (CZK)</option>
                    <option value="DKK">Danish Krone (DKK)</option>
                    <option value="DJF">Djiboutian Franc (DJF)</option>
                    <option value="DOP">Dominican Peso (DOP)</option>
                    <option value="XCD">East Caribbean Dollar (XCD)</option>
                    <option value="EGP">Egyptian Pound (EGP)</option>
                    <option value="ERN">Eritrean Nakfa (ERN)</option>
                    <option value="EEK">Estonian Kroon (EEK)</option>
                    <option value="ETB">Ethiopian Birr (ETB)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="FKP">Falkland Islands Pound (FKP)</option>
                    <option value="FJD">Fijian Dollar (FJD)</option>
                    <option value="GMD">Gambian Dalasi (GMD)</option>
                    <option value="GEL">Georgian Lari (GEL)</option>
                    <option value="DEM">German Mark (DEM)</option>
                    <option value="GHS">Ghanaian Cedi (GHS)</option>
                    <option value="GIP">Gibraltar Pound (GIP)</option>
                    <option value="GRD">Greek Drachma (GRD)</option>
                    <option value="GTQ">Guatemalan Quetzal (GTQ)</option>
                    <option value="GNF">Guinean Franc (GNF)</option>
                    <option value="GYD">Guyanaese Dollar (GYD)</option>
                    <option value="HTG">Haitian Gourde (HTG)</option>
                    <option value="HNL">Honduran Lempira (HNL)</option>
                    <option value="HKD">Hong Kong Dollar (HKD)</option>
                    <option value="HUF">Hungarian Forint (HUF)</option>
                    <option value="ISK">Icelandic KrÃ³na (ISK)</option>
                    <option value="INR">Indian Rupee (INR)</option>
                    <option value="IDR">Indonesian Rupiah (IDR)</option>
                    <option value="IRR">Iranian Rial (IRR)</option>
                    <option value="IQD">Iraqi Dinar (IQD)</option>
                    <option value="ILS">Israeli New Sheqel (ILS)</option>
                    <option value="ITL">Italian Lira (ITL)</option>
                    <option value="JMD">Jamaican Dollar (JMD)</option>
                    <option value="JPY">Japanese Yen (JPY)</option>
                    <option value="JOD">Jordanian Dinar (JOD)</option>
                    <option value="KZT">Kazakhstani Tenge (KZT)</option>
                    <option value="KES">Kenyan Shilling (KES)</option>
                    <option value="KWD">Kuwaiti Dinar (KWD)</option>
                    <option value="KGS">Kyrgystani Som (KGS)</option>
                    <option value="LAK">Laotian Kip (LAK)</option>
                    <option value="LVL">Latvian Lats (LVL)</option>
                    <option value="LBP">Lebanese Pound (LBP)</option>
                    <option value="LSL">Lesotho Loti (LSL)</option>
                    <option value="LRD">Liberian Dollar (LRD)</option>
                    <option value="LYD">Libyan Dinar (LYD)</option>
                    <option value="LTL">Lithuanian Litas (LTL)</option>
                    <option value="MOP">Macanese Pataca (MOP)</option>
                    <option value="MKD">Macedonian Denar (MKD)</option>
                    <option value="MGA">Malagasy Ariary (MGA)</option>
                    <option value="MWK">Malawian Kwacha (MWK)</option>
                    <option value="MYR">Malaysian Ringgit (MYR)</option>
                    <option value="MVR">Maldivian Rufiyaa (MVR)</option>
                    <option value="MRO">Mauritanian Ouguiya (MRO)</option>
                    <option value="MUR">Mauritian Rupee (MUR)</option>
                    <option value="MXN">Mexican Peso (MXN)</option>
                    <option value="MDL">Moldovan Leu (MDL)</option>
                    <option value="MNT">Mongolian Tugrik (MNT)</option>
                    <option value="MAD">Moroccan Dirham (MAD)</option>
                    <option value="MZM">Mozambican Metical (MZM)</option>
                    <option value="MMK">Myanmar Kyat (MMK)</option>
                    <option value="NAD">Namibian Dollar (NAD)</option>
                    <option value="NPR">Nepalese Rupee (NPR)</option>
                    <option value="ANG">Netherlands Antillean Guilder (ANG)</option>
                    <option value="TWD">New Taiwan Dollar (TWD)</option>
                    <option value="NZD">New Zealand Dollar (NZD)</option>
                    <option value="NIO">Nicaraguan CÃ³rdoba (NIO)</option>
                    <option value="NGN">Nigerian Naira (NGN)</option>
                    <option value="KPW">North Korean Won (KPW)</option>
                    <option value="NOK">Norwegian Krone (NOK)</option>
                    <option value="OMR">Omani Rial (OMR)</option>
                    <option value="PKR">Pakistani Rupee (PKR)</option>
                    <option value="PAB">Panamanian Balboa (PAB)</option>
                    <option value="PGK">Papua New Guinean Kina (PGK)</option>
                    <option value="PYG">Paraguayan Guarani (PYG)</option>
                    <option value="PEN">Peruvian Nuevo Sol (PEN)</option>
                    <option value="PHP">Philippine Peso (PHP)</option>
                    <option value="PLN">Polish Zloty (PLN)</option>
                    <option value="QAR">Qatari Rial (QAR)</option>
                    <option value="RON">Romanian Leu (RON)</option>
                    <option value="RUB">Russian Ruble (RUB)</option>
                    <option value="RWF">Rwandan Franc (RWF)</option>
                    <option value="SVC">Salvadoran ColÃ³n (SVC)</option>
                    <option value="WST">Samoan Tala (WST)</option>
                    <option value="SAR">Saudi Riyal (SAR)</option>
                    <option value="RSD">Serbian Dinar (RSD)</option>
                    <option value="SCR">Seychellois Rupee (SCR)</option>
                    <option value="SLL">Sierra Leonean Leone (SLL)</option>
                    <option value="SGD">Singapore Dollar (SGD)</option>
                    <option value="SKK">Slovak Koruna (SKK)</option>
                    <option value="SBD">Solomon Islands Dollar (SBD)</option>
                    <option value="SOS">Somali Shilling (SOS)</option>
                    <option value="ZAR">South African Rand (ZAR)</option>
                    <option value="KRW">South Korean Won (KRW)</option>
                    <option value="XDR">Special Drawing Rights (XDR)</option>
                    <option value="LKR">Sri Lankan Rupee (LKR)</option>
                    <option value="SHP">St. Helena Pound (SHP)</option>
                    <option value="SDG">Sudanese Pound (SDG)</option>
                    <option value="SRD">Surinamese Dollar (SRD)</option>
                    <option value="SZL">Swazi Lilangeni (SZL)</option>
                    <option value="SEK">Swedish Krona (SEK)</option>
                    <option value="CHF">Swiss Franc (CHF)</option>
                    <option value="SYP">Syrian Pound (SYP)</option>
                    <option value="STD">São Tomé and Príncipe Dobra (STD)</option>
                    <option value="TJS">Tajikistani Somoni (TJS)</option>
                    <option value="TZS">Tanzanian Shilling (TZS)</option>
                    <option value="THB">Thai Baht (THB)</option>
                    <option value="TOP">Tongan pa'anga (TOP)</option>
                    <option value="TTD">Trinidad & Tobago Dollar (TTD)</option>
                    <option value="TND">Tunisian Dinar (TND)</option>
                    <option value="TRY">Turkish Lira (TRY)</option>
                    <option value="TMT">Turkmenistani Manat (TMT)</option>
                    <option value="UGX">Ugandan Shilling (UGX)</option>
                    <option value="UAH">Ukrainian Hryvnia (UAH)</option>
                    <option value="AED">United Arab Emirates Dirham (AED)</option>
                    <option value="UYU">Uruguayan Peso (UYU)</option>
                    <option value="USD">US Dollar (USD)</option>
                    <option value="UZS">Uzbekistan Som (UZS)</option>
                    <option value="VUV">Vanuatu Vatu (VUV)</option>
                    <option value="VEF">Venezuelan BolÃ­var (VEF)</option>
                    <option value="VND">Vietnamese Dong (VND)</option>
                    <option value="YER">Yemeni Rial (YER)</option>
                    <option value="ZMK">Zambian Kwacha (ZMK)</option>
                    </select>
                  </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
         @endempty
        @foreach($tableData as $row)
        @csrf
        <div class="card-body">
        <input type="hidden" name="userid" id="userid" value="{{$row->id}}" />
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{ENV('APP_URL')}}/users/sitelogo/{{$row->siteLogo}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload Site Logo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" name="photo" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
           
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="siteTitle" class="form-label">Site Title</label>
              <input class="form-control" type="text" id="siteTitle" name="siteTitle" value="{{$row->siteTitle}}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
                    <label for="currency" class="form-label">Currency</label>
                    <select id="currency" name="currency" class="form-select"  aria-label="Default select example">
                    <option value="0">Select currency</option>
                    <option value="{{$row->currency}}" <?php echo $row->currency == $row->currency ? 'selected' : '' ?>>{{$row->currency}}</option>
                    <option value="AFN">Afghan Afghani (AFN)</option>
                    <option value="ALL">Albanian Lek (ALL)</option>
                    <option value="DZD">Algerian Dinar (DZD)</option>
                    <option value="AOA">Angolan Kwanza (AOA)</option>
                    <option value="ARS">Argentine Peso (ARS)</option>
                    <option value="AMD">Armenian Dram (AMD)</option>
                    <option value="AWG">Aruban Florin (AWG)</option>
                    <option value="AUD">Australian Dollar (AUD)</option>
                    <option value="AZN">Azerbaijani Manat (AZN)</option>
                    <option value="BSD">Bahamian Dollar (BSD)</option>
                    <option value="BHD">Bahraini Dinar (BHD)</option>
                    <option value="BDT">Bangladeshi Taka (BDT)</option>
                    <option value="BBD">Barbadian Dollar (BBD)</option>
                    <option value="BYR">Belarusian Ruble (BYR)</option>
                    <option value="BEF">Belgian Franc (BEF)</option>
                    <option value="BZD">Belize Dollar (BZD)</option>
                    <option value="BMD">Bermudan Dollar (BMD)</option>
                    <option value="BTN">Bhutanese Ngultrum (BTN)</option>
                    <option value="BOB">Bolivian Boliviano (BOB)</option>
                    <option value="BAM">Bosnia-Herzegovina Convertible Mark (BAM)</option>
                    <option value="BWP">Botswanan Pula (BWP)</option>
                    <option value="BRL">Brazilian Real (BRL)</option>
                    <option value="GBP">British Pound Sterling (GBP)</option>
                    <option value="BND">Brunei Dollar (BND)</option>
                    <option value="BGN">Bulgarian Lev (BGN)</option>
                    <option value="BIF">Burundian Franc (BIF)</option>
                    <option value="KHR">Cambodian Riel (KHR)</option>
                    <option value="CAD">Canadian Dollar (CAD)</option>
                    <option value="CVE">Cape Verdean Escudo (CVE)</option>
                    <option value="KYD">Cayman Islands Dollar (KYD)</option>
                    <option value="XOF">CFA Franc BCEAO (XOF)</option>
                    <option value="XAF">CFA Franc BEAC (XAF)</option>
                    <option value="XPF">CFP Franc (XPF)</option>
                    <option value="CLP">Chilean Peso (CLP)</option>
                    <option value="CNY">Chinese Yuan (CNY)</option>
                    <option value="COP">Colombian Peso (COP)</option>
                    <option value="KMF">Comorian Franc (KMF)</option>
                    <option value="CDF">Congolese Franc (CDF)</option>
                    <option value="CRC">Costa Rican ColÃ³n (CRC)</option>
                    <option value="HRK">Croatian Kuna (HRK)</option>
                    <option value="CUC">Cuban Convertible Peso (CUC)</option>
                    <option value="CZK">Czech Republic Koruna (CZK)</option>
                    <option value="DKK">Danish Krone (DKK)</option>
                    <option value="DJF">Djiboutian Franc (DJF)</option>
                    <option value="DOP">Dominican Peso (DOP)</option>
                    <option value="XCD">East Caribbean Dollar (XCD)</option>
                    <option value="EGP">Egyptian Pound (EGP)</option>
                    <option value="ERN">Eritrean Nakfa (ERN)</option>
                    <option value="EEK">Estonian Kroon (EEK)</option>
                    <option value="ETB">Ethiopian Birr (ETB)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="FKP">Falkland Islands Pound (FKP)</option>
                    <option value="FJD">Fijian Dollar (FJD)</option>
                    <option value="GMD">Gambian Dalasi (GMD)</option>
                    <option value="GEL">Georgian Lari (GEL)</option>
                    <option value="DEM">German Mark (DEM)</option>
                    <option value="GHS">Ghanaian Cedi (GHS)</option>
                    <option value="GIP">Gibraltar Pound (GIP)</option>
                    <option value="GRD">Greek Drachma (GRD)</option>
                    <option value="GTQ">Guatemalan Quetzal (GTQ)</option>
                    <option value="GNF">Guinean Franc (GNF)</option>
                    <option value="GYD">Guyanaese Dollar (GYD)</option>
                    <option value="HTG">Haitian Gourde (HTG)</option>
                    <option value="HNL">Honduran Lempira (HNL)</option>
                    <option value="HKD">Hong Kong Dollar (HKD)</option>
                    <option value="HUF">Hungarian Forint (HUF)</option>
                    <option value="ISK">Icelandic KrÃ³na (ISK)</option>
                    <option value="INR">Indian Rupee (INR)</option>
                    <option value="IDR">Indonesian Rupiah (IDR)</option>
                    <option value="IRR">Iranian Rial (IRR)</option>
                    <option value="IQD">Iraqi Dinar (IQD)</option>
                    <option value="ILS">Israeli New Sheqel (ILS)</option>
                    <option value="ITL">Italian Lira (ITL)</option>
                    <option value="JMD">Jamaican Dollar (JMD)</option>
                    <option value="JPY">Japanese Yen (JPY)</option>
                    <option value="JOD">Jordanian Dinar (JOD)</option>
                    <option value="KZT">Kazakhstani Tenge (KZT)</option>
                    <option value="KES">Kenyan Shilling (KES)</option>
                    <option value="KWD">Kuwaiti Dinar (KWD)</option>
                    <option value="KGS">Kyrgystani Som (KGS)</option>
                    <option value="LAK">Laotian Kip (LAK)</option>
                    <option value="LVL">Latvian Lats (LVL)</option>
                    <option value="LBP">Lebanese Pound (LBP)</option>
                    <option value="LSL">Lesotho Loti (LSL)</option>
                    <option value="LRD">Liberian Dollar (LRD)</option>
                    <option value="LYD">Libyan Dinar (LYD)</option>
                    <option value="LTL">Lithuanian Litas (LTL)</option>
                    <option value="MOP">Macanese Pataca (MOP)</option>
                    <option value="MKD">Macedonian Denar (MKD)</option>
                    <option value="MGA">Malagasy Ariary (MGA)</option>
                    <option value="MWK">Malawian Kwacha (MWK)</option>
                    <option value="MYR">Malaysian Ringgit (MYR)</option>
                    <option value="MVR">Maldivian Rufiyaa (MVR)</option>
                    <option value="MRO">Mauritanian Ouguiya (MRO)</option>
                    <option value="MUR">Mauritian Rupee (MUR)</option>
                    <option value="MXN">Mexican Peso (MXN)</option>
                    <option value="MDL">Moldovan Leu (MDL)</option>
                    <option value="MNT">Mongolian Tugrik (MNT)</option>
                    <option value="MAD">Moroccan Dirham (MAD)</option>
                    <option value="MZM">Mozambican Metical (MZM)</option>
                    <option value="MMK">Myanmar Kyat (MMK)</option>
                    <option value="NAD">Namibian Dollar (NAD)</option>
                    <option value="NPR">Nepalese Rupee (NPR)</option>
                    <option value="ANG">Netherlands Antillean Guilder (ANG)</option>
                    <option value="TWD">New Taiwan Dollar (TWD)</option>
                    <option value="NZD">New Zealand Dollar (NZD)</option>
                    <option value="NIO">Nicaraguan CÃ³rdoba (NIO)</option>
                    <option value="NGN">Nigerian Naira (NGN)</option>
                    <option value="KPW">North Korean Won (KPW)</option>
                    <option value="NOK">Norwegian Krone (NOK)</option>
                    <option value="OMR">Omani Rial (OMR)</option>
                    <option value="PKR">Pakistani Rupee (PKR)</option>
                    <option value="PAB">Panamanian Balboa (PAB)</option>
                    <option value="PGK">Papua New Guinean Kina (PGK)</option>
                    <option value="PYG">Paraguayan Guarani (PYG)</option>
                    <option value="PEN">Peruvian Nuevo Sol (PEN)</option>
                    <option value="PHP">Philippine Peso (PHP)</option>
                    <option value="PLN">Polish Zloty (PLN)</option>
                    <option value="QAR">Qatari Rial (QAR)</option>
                    <option value="RON">Romanian Leu (RON)</option>
                    <option value="RUB">Russian Ruble (RUB)</option>
                    <option value="RWF">Rwandan Franc (RWF)</option>
                    <option value="SVC">Salvadoran ColÃ³n (SVC)</option>
                    <option value="WST">Samoan Tala (WST)</option>
                    <option value="SAR">Saudi Riyal (SAR)</option>
                    <option value="RSD">Serbian Dinar (RSD)</option>
                    <option value="SCR">Seychellois Rupee (SCR)</option>
                    <option value="SLL">Sierra Leonean Leone (SLL)</option>
                    <option value="SGD">Singapore Dollar (SGD)</option>
                    <option value="SKK">Slovak Koruna (SKK)</option>
                    <option value="SBD">Solomon Islands Dollar (SBD)</option>
                    <option value="SOS">Somali Shilling (SOS)</option>
                    <option value="ZAR">South African Rand (ZAR)</option>
                    <option value="KRW">South Korean Won (KRW)</option>
                    <option value="XDR">Special Drawing Rights (XDR)</option>
                    <option value="LKR">Sri Lankan Rupee (LKR)</option>
                    <option value="SHP">St. Helena Pound (SHP)</option>
                    <option value="SDG">Sudanese Pound (SDG)</option>
                    <option value="SRD">Surinamese Dollar (SRD)</option>
                    <option value="SZL">Swazi Lilangeni (SZL)</option>
                    <option value="SEK">Swedish Krona (SEK)</option>
                    <option value="CHF">Swiss Franc (CHF)</option>
                    <option value="SYP">Syrian Pound (SYP)</option>
                    <option value="STD">São Tomé and Príncipe Dobra (STD)</option>
                    <option value="TJS">Tajikistani Somoni (TJS)</option>
                    <option value="TZS">Tanzanian Shilling (TZS)</option>
                    <option value="THB">Thai Baht (THB)</option>
                    <option value="TOP">Tongan pa'anga (TOP)</option>
                    <option value="TTD">Trinidad & Tobago Dollar (TTD)</option>
                    <option value="TND">Tunisian Dinar (TND)</option>
                    <option value="TRY">Turkish Lira (TRY)</option>
                    <option value="TMT">Turkmenistani Manat (TMT)</option>
                    <option value="UGX">Ugandan Shilling (UGX)</option>
                    <option value="UAH">Ukrainian Hryvnia (UAH)</option>
                    <option value="AED">United Arab Emirates Dirham (AED)</option>
                    <option value="UYU">Uruguayan Peso (UYU)</option>
                    <option value="USD">US Dollar (USD)</option>
                    <option value="UZS">Uzbekistan Som (UZS)</option>
                    <option value="VUV">Vanuatu Vatu (VUV)</option>
                    <option value="VEF">Venezuelan BolÃ­var (VEF)</option>
                    <option value="VND">Vietnamese Dong (VND)</option>
                    <option value="YER">Yemeni Rial (YER)</option>
                    <option value="ZMK">Zambian Kwacha (ZMK)</option>
                    </select>
                  </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
        @endforeach
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>

function checkvalidate()
{
  let siteTitle = document.getElementById('siteTitle').value;
  $(".error").remove();
    
  if (siteTitle.length < 1) {
  $('#siteTitle').after('<span class="error">Site Title is required*</span>');
  return false;
  }

  var selcurrency=$('#currency');
    if(selcurrency.val() == 0)
    {
      $('#currency').after('<span class="error"> Select a Valid Currency</span>');
      return false;
    }

  else{
  return true;
  }
}
</script>

@endsection