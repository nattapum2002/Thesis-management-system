<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('title')</title>
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
{{--
<link href="{{Asset('Asset/main/css/sidebar.css')}}" rel="stylesheet"> --}}
<link href="{{Asset('Asset/main/css/body.css')}}" rel="stylesheet">

<body>
    <div class="row">
        <div class="col-sm-2">
            {{-- Main Sidebar --}}
            <div class="sidebar">
                <div class="title">
                    <a href="/admin">
                        <i class='bx bx-user'></i>
                        <h4>dashboard</h4>
                    </a>

                    <div class="title-name">
                        <i class='bx bx-user'></i>
                        <span>Admin</span>
                    </div>
                </div>
                <ul style="list-style-type: none">
                    <div class="dropdown dropend">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class='bx bx-user'></i>
                            <span>โปรเจค</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/admin_project">จัดการโปรเจค</a></li>
                            <li><a href="/admin/approve_documents">อนุมัติเอกสาร</a></li>
                        </ul>
                    </div>
                    <div class="dropdown dropend">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class='bx bx-user'></i>
                            <span>จัดการบัญชีผู้ใช้</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/manage_teacher">จัดการบัญชีอาจารย์</a></li>
                            <li><a href="/admin/manage_member">จัดการบัญชีสมาชิก</a></li>
                            <li><a href="/admin/edit_admin">จัดการบัญชีผูดูแลระบบ</a></li>
                        </ul>
                    </div>
                    <div class="dropdown dropend">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class='bx bx-calendar-edit'></i>
                            <span>จัดการกำหนดการ</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/manage_exam_schedule">กำหนดกรรมการและเวลาสอบ</a></li>
                            <li><a href="/admin/manage_document_schedule">จัดการกำหนดการเอกสาร</a></li>
                        </ul>
                    </div>
                    <li><a href="/admin/manage_news"><i class='bx bx-news'></i>จัดการข่าวประชาสัมพันธ์</a></li>
                    <li><a href="/admin/manage_thesis"><i class='bx bx-book'></i>จัดการบทความปริญญานิพนธ์</a></li>
                </ul>

            </div>
        </div>
        <div class="col-sm-10">
            <div class="navbar">
                <a href="/admin"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <span class="fs-4">ระบบจัดการปริญญานิพนธ์</span>
                </a>

                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="/menu_thesis" class="nav-link">บทความปริญญานิพนธ์</a></li>
                    <li class="nav-item"><a href="/menu_news" class="nav-link">ข่าวประชาสัมพันธ์</a></li>
                    <li class="nav-item"><a href="https://computer.surin.rmuti.ac.th/computer/"
                            class="nav-link">เกียวกับสาขา</a></li>
                    <li class="btn btn-danger">ออกจากระบบ</li>
                </ul>
            </div>

            {{-- Content --}}
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // เลือก element ของช่องรับเหตุผล
        const document_reasonField = document.getElementById("document-reason-field");

        // เลือก radio buttons สำหรับการอนุมัติและไม่อนุมัติเอกสาร
        const document_approveRadio = document.getElementById("document-approval");
        const document_rejectRadio = document.getElementById("document-reject");

        // เมื่อมีการเปลี่ยนแปลงในการเลือก radio buttons
        document_approveRadio.addEventListener("change", function() {
            // ถ้าเลือก "อนุมัติเอกสาร"
            if (this.checked) {
                // ซ่อนช่องรับเหตุผล
                document_reasonField.style.display = "none";
            }
        });

        document_rejectRadio.addEventListener("change", function() {
            // ถ้าเลือก "ไม่อนุมัติเอกสาร"
            if (this.checked) {
                // แสดงช่องรับเหตุผล
                document_reasonField.style.display = "block";
            }
        });

        // เรียกใช้งานเงื่อนไขเมื่อหน้าเว็บโหลดเสร็จ
        window.addEventListener("load", function() {
            // ถ้าไม่มี radio button ใดถูกเลือกในตอนเริ่มต้น
            if (!document_approveRadio.checked && !document_rejectRadio.checked) {
                // ซ่อนช่องรับเหตุผล
                document_reasonField.style.display = "none";
            }
        });

        //---------------------------------------------------------------------

        // เลือก element ของช่องรับเหตุผล
        const advisor_reasonField = document.getElementById("reject-field");

        // เลือก radio buttons สำหรับการอนุมัติและไม่อนุมัติเอกสาร
        const advisor_approveRadio = document.getElementById("advisor-approval");
        const advisor_rejectRadio = document.getElementById("advisor-reject");

        // เมื่อมีการเปลี่ยนแปลงในการเลือก radio buttons
        advisor_approveRadio.addEventListener("change", function() {
            // ถ้าเลือก "อนุมัติเอกสาร"
            if (this.checked) {
                // ซ่อนช่องรับเหตุผล
                advisor_reasonField.style.display = "none";
            }
        });

        advisor_rejectRadio.addEventListener("change", function() {
            // ถ้าเลือก "ไม่อนุมัติเอกสาร"
            if (this.checked) {
                // แสดงช่องรับเหตุผล
                advisor_reasonField.style.display = "block";
            }
        });

        // เรียกใช้งานเงื่อนไขเมื่อหน้าเว็บโหลดเสร็จ
        window.addEventListener("load", function() {
            // ถ้าไม่มี radio button ใดถูกเลือกในตอนเริ่มต้น
            if (!advisor_approveRadio.checked && !advisor_rejectRadio.checked) {
                // ซ่อนช่องรับเหตุผล
                advisor_reasonField.style.display = "none";
            }
        });
    </script>
</body>

</html>
