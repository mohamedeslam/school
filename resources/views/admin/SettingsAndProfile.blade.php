@extends('layout.dashport-layout.master')
@section('titel',$titelPage)
@section('sidebar')
  <div class="col-lg-3 pe-0">
    @parent
    @section('sidebar-item')
    @endsection
  </div>
@endsection
@section('content')

  <div class="col-lg-9 vstack gap-2 pe-0">
    <div class="card">
        <!-- Card header START -->
        <div class="card-header border-0 p-3 pb-0">
            <h5 class="card-title">اعدادات الوصول للموقع</h5>
            <p class="mb-0">من هنا يتم التحكم في وصول المستجدمين للموقع </p>
        </div>
        <!-- Card header START -->
        <!-- Card body START -->
        <div class="card-body pb-0">
            <!-- Notification START -->
            <ul class="list-group list-group-flush p-0">
                <!-- Notification list item -->
                <li
                    class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                    <div class="me-2">
                        <h6 class="mb-0">وضع الصيانة</h6>
                        <p class="small mb-0">عن تفعيل هذا الوضع سيتم مع وصول المستجدمين
                            للموقع لحين الانتهاء من اعمال التطوير</p>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch"
                            id="NotiSwitchCheckChecked" checked="">
                    </div>
                </li>
            </ul>
            <!-- Notification END -->
        </div>
        <!-- Card body END -->
        <!-- Button save -->
        <div class="card-footer pt-0 text-end border-0">
            <button type="submit" class="btn btn-sm btn-primary mb-0">حفظ التقيرات</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <!-- Title START -->
                <div class="card-header border-0 pb-0">
                    <h1 class="h5 card-title">إعدادات الحساب</h1>
                    <p class="mb-0">هنا الاعدادات الخاصة بحساب مدير الموقع .</p>
                </div>
                <!-- Card header START -->
                <!-- Card body START -->
                <div class="card-body">
                    <!-- Form settings START -->
                    <form class="row g-3">
                        <!-- profile img -->
                        <div class="col-12 justify-content-center align-items-center">
                            <label class="form-label">صورة الملف الشخصي</label>
                            <div class="d-flex align-items-center">
                                <label class="position-relative ms-4" for="uploadfile-1"
                                    title="Replace this pic">
                                    <!-- Avatar place holder -->
                                    <span class="avatar avatar-xl">
                                        <img id="uploadfile-1-preview"
                                            class="avatar-img rounded-circle border border-white border-3 shadow"
                                            src="{{ asset('assets/plugins/imgs/IMG_2079.JPG') }}" alt="">
                                    </span>
                                </label>
                                <!-- Upload button -->
                                <label class="btn btn-dark btn-sm me-5 mb-0" for="uploadfile-1">تغير</label>
                                <input id="uploadfile-1" class="form-control d-none" type="file">
                            </div>
                        </div>
                        <!-- First name -->
                        <div class="col-sm-6 col-lg-6">
                            <label class="form-label">الإسم الأول</label>
                            <input type="text" class="form-control" placeholder="" value="محمد">
                        </div>
                        <!-- Last name -->
                        <div class="col-sm-6 col-lg-6">
                            <label class="form-label">الإسم الأب</label>
                            <input type="text" class="form-control" placeholder="" value="إسلام">
                        </div>
  
                        <!-- User name -->
                        <div class="col-lg-6">
                            <label class="form-label">إسم المستخدم</label>
                            <input type="text" class="form-control text-start" placeholder=""
                                value="@samlanson">
                        </div>
                        <!-- Birthday -->
                        <div class="col-lg-6">
                            <label class="form-label">تاريخ الميلاد</label>
                            <input type="text"
                                class="form-control text-center flatpickr flatpickr-input"
                                value="4/3/1997" readonly="readonly">
                        </div>
  
                        <div class="col-lg-12">
                            <div class="card-header border-0 p-0">
                                <h1 class="h5 card-title">إعدادات التواصل</h1>
                                <p class="mb-0"> هنا الإعدادات الخاصة مواقع التواصل الإجتماعي .</p>
                            </div>
                        </div>
                        <!-- site one -->
                        <div class="col-lg-6">
                            <label class="form-label">
                                رقم الهاتف</label>
                            <input type="text" class="form-control" value="" placeholder="2499+">
                        </div>
                        <!-- site two -->
                        <div class="col-lg-6">
                            <label class="form-label">
                                البريد الالكتروني
                                للموقع
                            </label>
                            <input type="text" class="form-control" value="site-two.com">
                        </div>
                        <!-- site three -->
                        <div class="col-lg-6">
                            <label class="form-label">
                                <i class="fab fa-facebook text-facebook me-2"></i>facebook cline
                            </label>
                            <input type="text" class="form-control" value="site-three.com">
                        </div>
                        <!-- site four -->
                        <div class="col-lg-6">
                            <label class="form-label"><i class="fab fa-facebook text-facebook me-2"></i>
                                facebook</label>
                            <input type="text" class="form-control" value="site-four.com">
                        </div>
                        <!-- Button  -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-sm btn-primary col-md-12 p-2 mb-0">حفظ
                                التقيرات</button>
                        </div>
                    </form>
                    <!-- Settings END -->
                </div>
                <!-- Card body END -->
            </div>
        </div>
        <div class="col-lg-4 pe-0 ">
            <div class="card">
                <!-- Title START -->
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title">اعادة تعين كلمة المرور</h5>
                </div>
                <!-- Title START -->
                <div class="card-body p-3">
                    <!-- Settings START -->
                    <form class="row g-3">
                        <!-- Current password -->
                        <div class="col-12">
                            <label class="form-label">كلمة المرور الحالية</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <!-- New password -->
                        <div class="col-12">
                            <label class="form-label">كلمة المرور الجديدة</label>
                            <input class="form-control fakepassword" type="password" id="psw-input"
                                placeholder="ادخل كلمة المرور الجديدة">
                        </div>
                        <!-- Confirm password -->
                        <div class="col-12">
                            <label class="form-label">تأكيد كلمة المرور</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <!-- Button  -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary col-md-12 mb-0">تحديث كلمة
                                المرور</button>
                        </div>
                    </form>
                    <!-- Settings END -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection