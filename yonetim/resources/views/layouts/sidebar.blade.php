<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('public/images/logo/adminlogo2.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">  Asansör Takip</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Görevler
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('gorev.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yeni Görev</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('gorev.index',1)}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Atadığım Görevler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('gorev.index',2)}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bana Atanan Görevler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('gorev.tamamlanan')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tamamlanan Görevler
                                    @if($tamgorev->count()>0)
                                    <span class="badge badge-info right">{{$tamgorev->count()}}</span>
                                    @endif
                                </p>

                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('gorev.arsiv')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Arşiv</p>
                            </a>
                        </li>

                    </ul>
                </li>



                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-door-closed"></i>
                        <p>
                            Asansör
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{route('asansor.index',1)}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Asansör Listesi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('asansor.pasifler')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pasif Asansörler</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('bolge.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bölgeler</p>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Arıza
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{route('ariza.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Arıza Kaydı Aç</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('ariza.arizalar')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Arızalar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('ariza.gecmis')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Arıza Geçmişi</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('ariza.mesailer')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Geçen Ay Mesailer</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-toolbox"></i>
                        <p>
                            Bakım
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{route('bakim.bakimYap')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bakım Yap</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('bakim.index',0)}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bakım Yapılması Gerekenler</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('bakim.bakimlar',0)}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bakım Geçmişi</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-retweet"></i>
                        <p>
                            Revizyon
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{route('revizyon.revizyonYap')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teklif Ver & Etiket Değiştir</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('revizyon.sozlesmeBekleyen')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teklif Verilen Asansörler</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('revizyon.teklifGecmis')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Geçmiş Teklifler</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('revizyon.revizyonGereken')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revizyon Yapılacak Asansörler</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('revizyon.revizyonGecmis')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revizyon Yapılan Asansörler</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-toolbox"></i>
                        <p>
                            SMS Hizmetleri
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{route('sms.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Numaraya SMS Gönder</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('sms.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yöneticiye SMS Gönder</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('sms.toplusms')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tüm Yöneticilere SMS Gönder</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('sms.gecmis')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Geçmişi</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{route('takvim.index')}}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Takvim
                        </p>

                    </a>
                </li>






                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Kullanıcı Yönetimi
                        </p>
                    </a>
                </li>
                @php


                    use App\BelgeModel;

                    $belge_hatirlatma = BelgeModel::whereRaw("DATE_ADD(NOW(), INTERVAL hatirlatma MONTH) >= gecerlilik AND NOW() < gecerlilik ")
                    ->where('hatirlatma','!=',15)
                        ->get();
                     $belge_hatirlatma2 = BelgeModel::whereRaw("DATE_ADD(NOW(), INTERVAL hatirlatma DAY) >= gecerlilik AND NOW() < gecerlilik ")
                    ->where('hatirlatma','=',15)
                        ->get();
                    $belge_gecmis = BelgeModel::whereRaw(" NOW() > gecerlilik ")
                        ->get();

                @endphp
                @can('muhasebe-method')
                    <li class="nav-item">
                        <a href="{{route('belge.index')}}" class="nav-link">
                            <i class="nav-icon far fa-file-pdf"></i>
                            <p>
                                Belge Yönetimi
                            </p>




                            <span style=" position: absolute; right: 10px; top: 50%; margin-top: -18px; ">
              @if(!$belge_gecmis->count() == 0)<small title="Geçerlilik Tarihi Geçen Belgeler " style="background-color:red;border-radius:2.625px; color:hsl(0, 0%, 100%);font-size:10.5px;font-weight:700;gap:normal;line-height:10.5px;padding:2.1px 6.3px 3.15px;text-align:center ">{{$belge_gecmis->count()}}</small>@endif
                                @if(!$belge_hatirlatma->count() == 0)     <small title="Geçerlilik Tarihi Yaklaşan Belgeler " style="background-color:#ffc107!important;border-radius:2.625px; color:hsl(0, 0%, 100%);font-size:10.5px;font-weight:700;gap:normal;line-height:10.5px;padding:2.1px 6.3px 3.15px;text-align:center ">{{$belge_hatirlatma->count() + $belge_hatirlatma2->count()}}</small>@endif
            </span>

                        </a>
                    </li>
                @endcan
                @can('muhasebe-method')
                <li class="nav-item">
                    <a href="{{route('muhasebe.home')}}" class="nav-link">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                            Muhasebe
                        </p>

                    </a>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="{{route('ayarlar.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Ayarlar
                        </p>
                    </a>
                </li>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
