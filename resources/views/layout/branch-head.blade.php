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
<link href="{{Asset('Asset/main/css/body2.css')}}" rel="stylesheet">

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
                        <span>Branch Head</span>
                    </div>
                </div>
                <ul style="list-style-type: none">
                    <div class="dropdown dropend">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class='bx bx-user'></i>
                            <span>โปรเจค</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">จัดการโปรเจค</a></li>
                            <li><a href="/branch-head/approve_documents_branch_head">อนุมัติเอกสาร</a></li>
                        </ul>
                    </div>
                    <li><a href="/branch-head/edit_branch_head"><i class='bx bx-user'></i>จัดการบัญชีผู้ใช้</a></li>
                    <li><a href="/branch-head/manage_news_branch_head"><i
                                class='bx bx-news'></i>จัดการข่าวประชาสัมพันธ์</a></li>
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
                    <li class="nav item"><a class="btn btn-danger" href="{{route('logout')}}">ออกจากระบบ</a></li>
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
        // เลือกปุ่มและฟิลด์ทั้งหมด
        const editButtons = document.querySelectorAll('.edit-button');
        const saveButtons = document.querySelectorAll('.save-button');
        const cancelButtons = document.querySelectorAll('.cancel-button');
        const inputFields = document.querySelectorAll('.input-field');

        // ซ่อนฟิลด์แก้ไขทั้งหมดเมื่อโหลดหน้าเว็บ
        window.addEventListener('load', () => {
            inputFields.forEach(field => field.style.display = 'none');
            saveButtons.forEach(button => button.style.display = 'none');
            cancelButtons.forEach(button => button.style.display = 'none');
        });

        // แสดงฟิลด์แก้ไขเมื่อคลิกปุ่มแก้ไข
        editButtons.forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                const targetId = button.getAttribute('data-target');
                const targetField = document.getElementById(targetId);
                targetField.style.display = 'block';
                button.style.display = 'none';
                const saveButton = targetField.querySelector('.save-button');
                const cancelButton = targetField.querySelector('.cancel-button');
                saveButton.style.display = 'block';
                cancelButton.style.display = 'block';
            });
        });

        // ซ่อนฟิลด์แก้ไขเมื่อคลิกปุ่มบันทึกหรือยกเลิก
        const hideField = (targetField) => {
            targetField.style.display = 'none';
            const editButton = document.querySelector(`.edit-button[data-target="${targetField.id}"]`);
            editButton.style.display = 'block';
            const saveButton = targetField.querySelector('.save-button');
            const cancelButton = targetField.querySelector('.cancel-button');
            saveButton.style.display = 'none';
            cancelButton.style.display = 'none';
        };

        saveButtons.forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                const targetField = button.closest('.input-field');
                hideField(targetField);
            });
        });

        cancelButtons.forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                const targetField = button.closest('.input-field');
                hideField(targetField);
            });
        });
    </script>
</body>

</html>