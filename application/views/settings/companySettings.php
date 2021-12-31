<div class="col-md-9 data-section">
    <div class="row hidden-md hidden-lg">
        <div class="col-xs-12 p-l-25 m-t-10">
            <button class="btn btn-inverse btn-outline" id="mobile-filter-toggle"><i class="fa fa-sliders"></i></button>
        </div>
    </div>
<div class="stats-box">                               
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-settings"></i> Company Settings</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="https://demo.worksuite.biz/admin/dashboard">Home</a></li>
                <li class="active">Company Settings</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

                        <!-- .row -->
                
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    Update Organization Settings                    
                        <a href="javascript:;" id="clear-cache" class="btn btn-sm btn-danger pull-right m-l-5"><i class="fa fa-times"></i> Disable Cache</a>
                        <h6 class=" pull-right m-r-5">Cache is Enabled</h6>
                </div>

                <div class="vtabs customvtab m-t-10">
                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form method="POST" action="https://demo.worksuite.biz/admin/settings" accept-charset="UTF-8" id="editSettings" class="ajax-form">
                                        <input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="YEHq8E83iEyTiDzMcAzAGJqOSc7Q5gVvUYF5Okw0">
                                        <div class="form-group">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="Worksuite">
                                        </div>
                                        <div class="form-group">
                                            <label for="company_email">Company Email</label>
                                            <input type="email" class="form-control" id="company_email" name="company_email" value="company@email.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="company_phone">Company Phone</label>
                                            <input type="tel" class="form-control" id="company_phone" name="company_phone" value="1234567891">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Company Website</label>
                                            <input type="text" class="form-control" id="website" name="website" value="www.domain.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Company Logo</label>
                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>                                                  
                                                        <div>
                                                            <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new"> Select Image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="logo" id="logo"> </span>
                                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="m-t-20">Login Screen Background</label>
                                            <div class="col-md-12 m-b-20">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                         <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>                                               <div>
                                                            <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new"> Select Image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="login_background" id="login_background"> </span>
                                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                    <div class="note">Recommended size: 1500 X 1056 (Pixels)</div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Company Address</label>
                                                <textarea class="form-control" id="address" rows="5" name="address">Company address</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Default Currency</label>
                                                <select name="currency_id" id="currency_id" class="form-control">
                                                    <option selected="" value="1">$ (USD)</option>
                                                    <option value="2">£ (GBP)</option>
                                                    <option value="3">€ (EUR)</option>
                                                    <option value="4">₹ (INR)</option>
                                                </select>
                                            </div>
                                        <div class="form-group">
                                            <label for="address">Default Timezone</label>
                                       
                                            <select name="timezone" id="timezone" class="form-control select2" tabindex="-1" title="">
                                                <option>Africa/Abidjan</option>
                                                <option>Africa/Accra</option>
                                                <option>Africa/Addis_Ababa</option>
                                                <option>Africa/Algiers</option>
                                                <option>Africa/Asmara</option>
                                                <option>Africa/Bamako</option>
                                                <option>Africa/Bangui</option>
                                                <option>Africa/Banjul</option>
                                                <option>Africa/Bissau</option>
                                                <option>Africa/Blantyre</option>
                                                <option>Africa/Brazzaville</option>
                                                <option>Africa/Bujumbura</option>
                                                <option>Africa/Cairo</option>
                                                <option>Africa/Casablanca</option>
                                                <option>Africa/Ceuta</option>
                                                <option>Africa/Conakry</option>
                                                <option>Africa/Dakar</option>
                                                <option>Africa/Dar_es_Salaam</option>
                                                <option>Africa/Djibouti</option>
                                                <option>Africa/Douala</option>
                                                <option>Africa/El_Aaiun</option>
                                                <option>Africa/Freetown</option>
                                                <option>Africa/Gaborone</option>
                                                <option>Africa/Harare</option>
                                                <option>Africa/Johannesburg</option>
                                                <option>Africa/Juba</option>
                                                <option>Africa/Kampala</option>
                                                <option>Africa/Khartoum</option>
                                                <option>Africa/Kigali</option>
                                                <option>Africa/Kinshasa</option>
                                                <option>Africa/Lagos</option>
                                                <option>Africa/Libreville</option>
                                                <option>Africa/Lome</option>
                                                <option>Africa/Luanda</option>
                                                <option>Africa/Lubumbashi</option>
                                                <option>Africa/Lusaka</option>
                                                <option>Africa/Malabo</option>
                                                <option>Africa/Maputo</option>
                                                <option>Africa/Maseru</option>
                                                <option>Africa/Mbabane</option>
                                                <option>Africa/Mogadishu</option>
                                                <option>Africa/Monrovia</option>
                                                <option>Africa/Nairobi</option>
                                                <option>Africa/Ndjamena</option>
                                                <option>Africa/Niamey</option>
                                                <option>Africa/Nouakchott</option>
                                                <option>Africa/Ouagadougou</option>
                                                <option>Africa/Porto-Novo</option>
                                                <option>Africa/Sao_Tome</option>
                                                <option>Africa/Tripoli</option>
                                                <option>Africa/Tunis</option>
                                                <option>Africa/Windhoek</option>
                                                <option>America/Adak</option>
                                                <option>America/Anchorage</option>
                                                <option>America/Anguilla</option>
                                                <option>America/Antigua</option>
                                                <option>America/Araguaina</option>
                                                <option>America/Argentina/Buenos_Aires</option>
                                                <option>America/Argentina/Catamarca</option>
                                                <option>America/Argentina/Cordoba</option>
                                                <option>America/Argentina/Jujuy</option>
                                                <option>America/Argentina/La_Rioja</option>
                                                <option>America/Argentina/Mendoza</option>
                                                <option>America/Argentina/Rio_Gallegos</option>
                                                <option>America/Argentina/Salta</option>
                                                <option>America/Argentina/San_Juan</option>
                                                <option>America/Argentina/San_Luis</option>
                                                <option>America/Argentina/Tucuman</option>
                                                <option>America/Argentina/Ushuaia</option>
                                                <option>America/Aruba</option>
                                                <option>America/Asuncion</option>
                                                <option>America/Atikokan</option>
                                                <option>America/Bahia</option>
                                                <option>America/Bahia_Banderas</option>
                                                <option>America/Barbados</option>
                                                <option>America/Belem</option>
                                                <option>America/Belize</option>
                                                <option>America/Blanc-Sablon</option>
                                                <option>America/Boa_Vista</option>
                                                <option>America/Bogota</option>
                                                <option>America/Boise</option>
                                                <option>America/Cambridge_Bay</option>
                                                <option>America/Campo_Grande</option>
                                                <option>America/Cancun</option>
                                                <option>America/Caracas</option>
                                                <option>America/Cayenne</option>
                                                <option>America/Cayman</option>
                                                <option>America/Chicago</option>
                                                <option>America/Chihuahua</option>
                                                <option>America/Costa_Rica</option>
                                                <option>America/Creston</option>
                                                <option>America/Cuiaba</option>
                                                <option>America/Curacao</option>
                                                <option>America/Danmarkshavn</option>
                                                <option>America/Dawson</option>
                                                <option>America/Dawson_Creek</option>
                                                <option>America/Denver</option>
                                                <option>America/Detroit</option>
                                                <option>America/Dominica</option>
                                                <option>America/Edmonton</option>
                                                <option>America/Eirunepe</option>
                                                <option>America/El_Salvador</option>
                                                <option>America/Fort_Nelson</option>
                                                <option>America/Fortaleza</option>
                                                <option>America/Glace_Bay</option>
                                                <option>America/Godthab</option>
                                                <option>America/Goose_Bay</option>
                                                <option>America/Grand_Turk</option>
                                                <option>America/Grenada</option>
                                                <option>America/Guadeloupe</option>
                                                <option>America/Guatemala</option>
                                                <option>America/Guayaquil</option>
                                                <option>America/Guyana</option>
                                                <option>America/Halifax</option>
                                                <option>America/Havana</option>
                                                <option>America/Hermosillo</option>
                                                <option>America/Indiana/Indianapolis</option>
                                                <option>America/Indiana/Knox</option>
                                                <option>America/Indiana/Marengo</option>
                                                <option>America/Indiana/Petersburg</option>
                                                <option>America/Indiana/Tell_City</option>
                                                <option>America/Indiana/Vevay</option>
                                                <option>America/Indiana/Vincennes</option>
                                                <option>America/Indiana/Winamac</option>
                                                <option>America/Inuvik</option>
                                                <option>America/Iqaluit</option>
                                                <option>America/Jamaica</option>
                                                <option>America/Juneau</option>
                                                <option>America/Kentucky/Louisville</option>
                                                <option>America/Kentucky/Monticello</option>
                                                <option>America/Kralendijk</option>
                                                <option>America/La_Paz</option>
                                                <option>America/Lima</option>
                                                <option>America/Los_Angeles</option>
                                                <option>America/Lower_Princes</option>
                                                <option>America/Maceio</option>
                                                <option>America/Managua</option>
                                                <option>America/Manaus</option>
                                                <option>America/Marigot</option>
                                                <option>America/Martinique</option>
                                                <option>America/Matamoros</option>
                                                <option>America/Mazatlan</option>
                                                <option>America/Menominee</option>
                                                <option>America/Merida</option>
                                                <option>America/Metlakatla</option>
                                                <option>America/Mexico_City</option>
                                                <option>America/Miquelon</option>
                                                <option>America/Moncton</option>
                                                <option>America/Monterrey</option>
                                                <option>America/Montevideo</option>
                                                <option>America/Montserrat</option>
                                                <option>America/Nassau</option>
                                                <option>America/New_York</option>
                                                <option>America/Nipigon</option>
                                                <option>America/Nome</option>
                                                <option>America/Noronha</option>
                                                <option>America/North_Dakota/Beulah</option>
                                                <option>America/North_Dakota/Center</option>
                                                <option>America/North_Dakota/New_Salem</option>
                                                <option>America/Ojinaga</option>
                                                <option>America/Panama</option>
                                                <option>America/Pangnirtung</option>
                                                <option>America/Paramaribo</option>
                                                <option>America/Phoenix</option>
                                                <option>America/Port-au-Prince</option>
                                                <option>America/Port_of_Spain</option>
                                                <option>America/Porto_Velho</option>
                                                <option>America/Puerto_Rico</option>
                                                <option>America/Punta_Arenas</option>
                                                <option>America/Rainy_River</option>
                                                <option>America/Rankin_Inlet</option>
                                                <option>America/Recife</option>
                                                <option>America/Regina</option>
                                                <option>America/Resolute</option>
                                                <option>America/Rio_Branco</option>
                                                <option>America/Santarem</option>
                                                <option>America/Santiago</option>
                                                <option>America/Santo_Domingo</option>
                                                <option>America/Sao_Paulo</option>
                                                <option>America/Scoresbysund</option>
                                                <option>America/Sitka</option>
                                                <option>America/St_Barthelemy</option>
                                                <option>America/St_Johns</option>
                                                <option>America/St_Kitts</option>
                                                <option>America/St_Lucia</option>
                                                <option>America/St_Thomas</option>
                                                <option>America/St_Vincent</option>
                                                <option>America/Swift_Current</option>
                                                <option>America/Tegucigalpa</option>
                                                <option>America/Thule</option>
                                                <option>America/Thunder_Bay</option>
                                                <option>America/Tijuana</option>
                                                <option>America/Toronto</option>
                                                <option>America/Tortola</option>
                                                <option>America/Vancouver</option>
                                                <option>America/Whitehorse</option>
                                                <option>America/Winnipeg</option>
                                                <option>America/Yakutat</option>
                                                <option>America/Yellowknife</option>
                                                <option>Antarctica/Casey</option>
                                                <option>Antarctica/Davis</option>
                                                <option>Antarctica/DumontDUrville</option>
                                                <option>Antarctica/Macquarie</option>
                                                <option>Antarctica/Mawson</option>
                                                <option>Antarctica/McMurdo</option>
                                                <option>Antarctica/Palmer</option>
                                                <option>Antarctica/Rothera</option>
                                                <option>Antarctica/Syowa</option>
                                                <option>Antarctica/Troll</option>
                                                <option>Antarctica/Vostok</option>
                                                <option>Arctic/Longyearbyen</option>
                                                <option>Asia/Aden</option>
                                                <option>Asia/Almaty</option>
                                                <option>Asia/Amman</option>
                                                <option>Asia/Anadyr</option>
                                                <option>Asia/Aqtau</option>
                                                <option>Asia/Aqtobe</option>
                                                <option>Asia/Ashgabat</option>
                                                <option>Asia/Atyrau</option>
                                                <option>Asia/Baghdad</option>
                                                <option>Asia/Bahrain</option>
                                                <option>Asia/Baku</option>
                                                <option>Asia/Bangkok</option>
                                                <option>Asia/Barnaul</option>
                                                <option>Asia/Beirut</option>
                                                <option>Asia/Bishkek</option>
                                                <option>Asia/Brunei</option>
                                                <option>Asia/Chita</option>
                                                <option>Asia/Choibalsan</option>
                                                <option>Asia/Colombo</option>
                                                <option>Asia/Damascus</option>
                                                <option>Asia/Dhaka</option>
                                                <option>Asia/Dili</option>
                                                <option>Asia/Dubai</option>
                                                <option>Asia/Dushanbe</option>
                                                <option>Asia/Famagusta</option>
                                                <option>Asia/Gaza</option>
                                                <option>Asia/Hebron</option>
                                                <option>Asia/Ho_Chi_Minh</option>
                                                <option>Asia/Hong_Kong</option>
                                                <option>Asia/Hovd</option>
                                                <option>Asia/Irkutsk</option>
                                                <option>Asia/Jakarta</option>
                                                <option>Asia/Jayapura</option>
                                                <option>Asia/Jerusalem</option>
                                                <option>Asia/Kabul</option>
                                                <option>Asia/Kamchatka</option>
                                                <option>Asia/Karachi</option>
                                                <option>Asia/Kathmandu</option>
                                                <option>Asia/Khandyga</option>
                                                <option selected="">Asia/Kolkata</option>
                                                <option>Asia/Krasnoyarsk</option>
                                                <option>Asia/Kuala_Lumpur</option>
                                                <option>Asia/Kuching</option>
                                                <option>Asia/Kuwait</option>
                                                <option>Asia/Macau</option>
                                                <option>Asia/Magadan</option>
                                                <option>Asia/Makassar</option>
                                                <option>Asia/Manila</option>
                                                <option>Asia/Muscat</option>
                                                <option>Asia/Nicosia</option>
                                                <option>Asia/Novokuznetsk</option>
                                                <option>Asia/Novosibirsk</option>
                                                <option>Asia/Omsk</option>
                                                <option>Asia/Oral</option>
                                                <option>Asia/Phnom_Penh</option>
                                                <option>Asia/Pontianak</option>
                                                <option>Asia/Pyongyang</option>
                                                <option>Asia/Qatar</option>
                                                <option>Asia/Qostanay</option>
                                                <option>Asia/Qyzylorda</option>
                                                <option>Asia/Riyadh</option>
                                                <option>Asia/Sakhalin</option>
                                                <option>Asia/Samarkand</option>
                                                <option>Asia/Seoul</option>
                                                <option>Asia/Shanghai</option>
                                                <option>Asia/Singapore</option>
                                                <option>Asia/Srednekolymsk</option>
                                                <option>Asia/Taipei</option>
                                                <option>Asia/Tashkent</option>
                                                <option>Asia/Tbilisi</option>
                                                <option>Asia/Tehran</option>
                                                <option>Asia/Thimphu</option>
                                                <option>Asia/Tokyo</option>
                                                <option>Asia/Tomsk</option>
                                                <option>Asia/Ulaanbaatar</option>
                                                <option>Asia/Urumqi</option>
                                                <option>Asia/Ust-Nera</option>
                                                <option>Asia/Vientiane</option>
                                                <option>Asia/Vladivostok</option>
                                                <option>Asia/Yakutsk</option>
                                                <option>Asia/Yangon</option>
                                                <option>Asia/Yekaterinburg</option>
                                                <option>Asia/Yerevan</option>
                                                <option>Atlantic/Azores</option>
                                                <option>Atlantic/Bermuda</option>
                                                <option>Atlantic/Canary</option>
                                                <option>Atlantic/Cape_Verde</option>
                                                <option>Atlantic/Faroe</option>
                                                <option>Atlantic/Madeira</option>
                                                <option>Atlantic/Reykjavik</option>
                                                <option>Atlantic/South_Georgia</option>
                                                <option>Atlantic/St_Helena</option>
                                                <option>Atlantic/Stanley</option>
                                                <option>Australia/Adelaide</option>
                                                <option>Australia/Brisbane</option>
                                                <option>Australia/Broken_Hill</option>
                                                <option>Australia/Currie</option>
                                                <option>Australia/Darwin</option>
                                                <option>Australia/Eucla</option>
                                                <option>Australia/Hobart</option>
                                                <option>Australia/Lindeman</option>
                                                <option>Australia/Lord_Howe</option>
                                                <option>Australia/Melbourne</option>
                                                <option>Australia/Perth</option>
                                                <option>Australia/Sydney</option>
                                                <option>Europe/Amsterdam</option>
                                                <option>Europe/Andorra</option>
                                                <option>Europe/Astrakhan</option>
                                                <option>Europe/Athens</option>
                                                <option>Europe/Belgrade</option>
                                                <option>Europe/Berlin</option>
                                                <option>Europe/Bratislava</option>
                                                <option>Europe/Brussels</option>
                                                <option>Europe/Bucharest</option>
                                                <option>Europe/Budapest</option>
                                                <option>Europe/Busingen</option>
                                                <option>Europe/Chisinau</option>
                                                <option>Europe/Copenhagen</option>
                                                <option>Europe/Dublin</option>
                                                <option>Europe/Gibraltar</option>
                                                <option>Europe/Guernsey</option>
                                                <option>Europe/Helsinki</option>
                                                <option>Europe/Isle_of_Man</option>
                                                <option>Europe/Istanbul</option>
                                                <option>Europe/Jersey</option>
                                                <option>Europe/Kaliningrad</option>
                                                <option>Europe/Kiev</option>
                                                <option>Europe/Kirov</option>
                                                <option>Europe/Lisbon</option>
                                                <option>Europe/Ljubljana</option>
                                                <option>Europe/London</option>
                                                <option>Europe/Luxembourg</option>
                                                <option>Europe/Madrid</option>
                                                <option>Europe/Malta</option>
                                                <option>Europe/Mariehamn</option>
                                                <option>Europe/Minsk</option>
                                                <option>Europe/Monaco</option>
                                                <option>Europe/Moscow</option>
                                                <option>Europe/Oslo</option>
                                                <option>Europe/Paris</option>
                                                <option>Europe/Podgorica</option>
                                                <option>Europe/Prague</option>
                                                <option>Europe/Riga</option>
                                                <option>Europe/Rome</option>
                                                <option>Europe/Samara</option>
                                                <option>Europe/San_Marino</option>
                                                <option>Europe/Sarajevo</option>
                                                <option>Europe/Saratov</option>
                                                <option>Europe/Simferopol</option>
                                                <option>Europe/Skopje</option>
                                                <option>Europe/Sofia</option>
                                                <option>Europe/Stockholm</option>
                                                <option>Europe/Tallinn</option>
                                                <option>Europe/Tirane</option>
                                                <option>Europe/Ulyanovsk</option>
                                                <option>Europe/Uzhgorod</option>
                                                <option>Europe/Vaduz</option>
                                                <option>Europe/Vatican</option>
                                                <option>Europe/Vienna</option>
                                                <option>Europe/Vilnius</option>
                                                <option>Europe/Volgograd</option>
                                                <option>Europe/Warsaw</option>
                                                <option>Europe/Zagreb</option>
                                                <option>Europe/Zaporozhye</option>
                                                <option>Europe/Zurich</option>
                                                <option>Indian/Antananarivo</option>
                                                <option>Indian/Chagos</option>
                                                <option>Indian/Christmas</option>
                                                <option>Indian/Cocos</option>
                                                <option>Indian/Comoro</option>
                                                <option>Indian/Kerguelen</option>
                                                <option>Indian/Mahe</option>
                                                <option>Indian/Maldives</option>
                                                <option>Indian/Mauritius</option>
                                                <option>Indian/Mayotte</option>
                                                <option>Indian/Reunion</option>
                                                <option>Pacific/Apia</option>
                                                <option>Pacific/Auckland</option>
                                                <option>Pacific/Bougainville</option>
                                                <option>Pacific/Chatham</option>
                                                <option>Pacific/Chuuk</option>
                                                <option>Pacific/Easter</option>
                                                <option>Pacific/Efate</option>
                                                <option>Pacific/Enderbury</option>
                                                <option>Pacific/Fakaofo</option>
                                                <option>Pacific/Fiji</option>
                                                <option>Pacific/Funafuti</option>
                                                <option>Pacific/Galapagos</option>
                                                <option>Pacific/Gambier</option>
                                                <option>Pacific/Guadalcanal</option>
                                                <option>Pacific/Guam</option>
                                                <option>Pacific/Honolulu</option>
                                                <option>Pacific/Kiritimati</option>
                                                <option>Pacific/Kosrae</option>
                                                <option>Pacific/Kwajalein</option>
                                                <option>Pacific/Majuro</option>
                                                <option>Pacific/Marquesas</option>
                                                <option>Pacific/Midway</option>
                                                <option>Pacific/Nauru</option>
                                                <option>Pacific/Niue</option>
                                                <option>Pacific/Norfolk</option>
                                                <option>Pacific/Noumea</option>
                                                <option>Pacific/Pago_Pago</option>
                                                <option>Pacific/Palau</option>
                                                <option>Pacific/Pitcairn</option>
                                                <option>Pacific/Pohnpei</option>
                                                <option>Pacific/Port_Moresby</option>
                                                <option>Pacific/Rarotonga</option>
                                                <option>Pacific/Saipan</option>
                                                <option>Pacific/Tahiti</option>
                                                <option>Pacific/Tarawa</option>
                                                <option>Pacific/Tongatapu</option>
                                                <option>Pacific/Wake</option>
                                                <option>Pacific/Wallis</option>
                                                <option>UTC</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Date Format</label>
                                                <select name="date_format" id="date_format" class="form-control select2" tabindex="-1" title="">
                                                    <option value="d-m-Y" selected="">d-m-Y (01-01-2020)
                                                    </option>
                                                    <option value="m-d-Y"> m-d-Y (01-01-2020)
                                                    </option>
                                                    <option value="Y-m-d">Y-m-d (2020-01-01)
                                                    </option>
                                                    <option value="d.m.Y">d.m.Y (01.01.2020)
                                                    </option>
                                                    <option value="m.d.Y">m.d.Y (01.01.2020)
                                                    </option>
                                                    <option value="Y.m.d">Y.m.d (2020.01.01)
                                                    </option>
                                                    <option value="d/m/Y">d/m/Y (01/01/2020)
                                                    </option>
                                                    <option value="m/d/Y">m/d/Y (01/01/2020)
                                                    </option>
                                                    <option value="Y/m/d">Y/m/d (2020/01/01)
                                                    </option>
                                                    <option value="d-M-Y">d-M-Y (01-Jan-2020)
                                                    </option>
                                                    <option value="d/M/Y">d/M/Y (01/Jan/2020)
                                                    </option>
                                                    <option value="d.M.Y">d.M.Y (01.Jan.2020)
                                                    </option>
                                                    <option value="d-M-Y">d-M-Y (01-Jan-2020)
                                                    </option>
                                                    <option value="d M Y">d M Y (01 Jan 2020)
                                                    </option>
                                                    <option value="d F, Y">d F, Y(01 January, 2020)
                                                    </option>
                                                    <option value="D/M/Y">D/M/Y (Wed/Jan/2020)
                                                    </option>
                                                    <option value="D.M.Y">D.M.Y (Wed.Jan.2020)
                                                    </option>
                                                    <option value="D-M-Y">D-M-Y (Wed-Jan-2020)
                                                    </option>
                                                    <option value="D M Y">D M Y (Wed Jan 2020)
                                                    </option>
                                                    <option value="d D M Y">d D M Y(01 Wed Jan 2020)
                                                    </option>
                                                    <option value="D d M Y">D d M Y(Wed 01 Jan 2020)
                                                    </option>
                                                    <option value="dS M Y">dS M Y(01st Jan 2020)
                                                    </option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Time Format</label>
                                            <select name="time_format" id="time_format" class="form-control select2" tabindex="-1" title="">
                                                <option value="h:i A">12 Hour (6:20 PM)</option>
                                                <option value="h:i a">12 Hour (6:20 pm)</option>
                                                <option value="H:i">24Hour (18:20)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Change Language</label>
                                                <select name="locale" id="locale" class="form-control select2" tabindex="-1" title="">
                                                    <option selected="" value="en">English</option>
                                                    <option value="es">Spanish</option>
                                                    <option value="fr">French</option>
                                                    <option value="ru">Russian</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" class="form-control" id="latitude" name="latitude" value="26.91243360">
                                        </div>
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" class="form-control" id="longitude" name="longitude" value="75.78727090">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Google Recaptcha                                                    <!-- a class="mytooltip" href="javascript:void(0)">
                                                            <i class="fa fa-info-circle"></i>
                                                            <span class="tooltip-content5">
                                                                <span class="tooltip-text3">
                                                                    <span class="tooltip-inner2">
                                                                        Show google recaptcha on login page                                                                </span>
                                                                </span>
                                                            </span>
                                                        </a> -->
                                                    </label>
                                                    <div class="switchery-demo">
                                                        <input type="radio" name="recaptcha" id="recaptcha">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row key" id="google_recaptcha_key_div" style="display:none;">
                                            <div class="col-sm-12 col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="google_recaptcha_key">Google Recaptcha Key</label>
                                                    <input type="text" class="form-control" id="google_recaptcha_key" name="google_recaptcha_key" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row secret" id="google_recaptcha_secret_div" style="display:none;">
                                            <div class="col-sm-12 col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="google_recaptcha_secret">Google Recaptcha Secret</label>
                                                    <input type="text" class="form-control" id="google_recaptcha_secret" name="google_recaptcha_secret" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">App Update          
                                                       <!--  <a class="mytooltip" href="javascript:void(0)">
                                                            <i class="fa fa-info-circle"></i>
                                                            <span class="tooltip-content5">
                                                                <span class="tooltip-text3">
                                                                    <span class="tooltip-inner2">
                                                                    Enable/Disable app update setting.                 
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </a> -->
                                                    </label>
                                                    <div class="switchery-demo">
                                                        <input type="radio" name="app">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <button type="submit" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">Update</button>
                                            <button type="reset" id="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
                                    </form>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
    </div>


    </div>
    <!-- .row -->


                <!-- .right-sidebar -->
    <div class="right-sidebar">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="slimscrollright" id="right-sidebar-content" style="overflow: hidden; width: auto; height: 100%;">

        </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
    </div>
<!-- /.right-sidebar -->
</div>
</div>