<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard - Kelola Member</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --color-primary-50: #eff6ff;
                --color-primary-100: #dbeafe;
                --color-primary-200: #bfdbfe;
                --color-primary-300: #93c5fd;
                --color-primary-400: #60a5fa;
                --color-primary-500: #3b82f6;
                --color-primary-600: #2563eb;
                --color-primary-700: #1d4ed8;
                --color-primary-800: #1e40af;
                --color-primary-900: #1e3a8a;
            }
        </style>
    </head>
    <body class="">
        <header>
        <nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-white">
            <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-6 py-4">
                <!-- Logo / Brand -->
                <a href="/dashboard" class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-lg font-bold text-white">
                        M
                    </div>
                </a>

                <!-- Hamburger Mobile -->
                <button
                    id="menu-toggle"
                    type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 md:hidden"
                    aria-controls="navbar-menu"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Navigation Menu -->
                <div id="navbar-menu" class="hidden w-full md:block md:w-auto">
                    <ul class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-white p-4 font-medium md:mt-0 md:flex-row md:items-center md:gap-8 md:border-0 md:p-0">

                        <li>
                            <a href="/dashboard"
                                class="block rounded px-3 py-2 text-blue-600 md:p-0"
                                aria-current="page">
                                Home
                            </a>
                        </li>

                        <li>
                            <button href="#about" id="btnLogout"
                                class="block rounded px-3 py-2 text-gray-900 hover:bg-gray-100 md:p-0 md:hover:bg-transparent md:hover:text-blue-600 hover:cursor-pointer">
                                Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        </header>

        <h1 class="mt-[100px] text-2xl font-bold"> Daftar Member</h1>
    
        <div class="relative mt-[50px] overflow-x-auto rounded-2xl border border-gray-200 bg-white shadow-sm">
            <button type="button" id="openModalCreate" onclick="openModal('create')" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                Tambah Member
            </button>
            <table class="w-full text-left text-base text-gray-700">
                <thead class="border-b border-gray-200 bg-gray-50 text-gray-700">
                    <tr>
                        <th scope="col" class="px-7 py-4 font-medium">
                            Nama Member
                        </th>
                        <th scope="col" class="px-7 py-4 font-medium">
                            Email Member
                        </th>
                        <th scope="col" class="px-7 py-4 font-medium">
                            Hobi Member
                        </th>
                        <th scope="col" class="px-7 py-4 font-medium">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody id="tableMembers"></tbody>
            </table>
        </div>

        <div
            id="crud-modal"
            class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-black/50 p-4"
        >
            <!-- Modal content -->
            <div class="relative w-full max-w-md rounded-xl border border-gray-200 bg-white p-4 shadow-xl sm:p-6">

                <!-- Modal header -->
                <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-semibold text-gray-900" id="modal-title">
                        Create new member
                    </h3>

                    <button
                        type="button"
                        id="closeModal"
                        aria-label="Close modal"
                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal body -->
                <section id="memberForm">
                    <div class="grid grid-cols-2 gap-4 py-5">
                        <div class="col-span-2">
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-900">
                                Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Enter member name"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none"
                            >
                        </div>

                        <div class="col-span-2">
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="name@example.com"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none"
                            >
                        </div>

                        <div class="col-span-2">
                            <label for="hobbies" class="mb-2 block text-sm font-medium text-gray-900">
                                Hobi
                            </label>
                            <input
                                type="text"
                                name="hobbies"
                                id="hobbies"
                                placeholder="Coding, Gaming, Reading"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none"
                            >
                            <p class="mt-1.5 text-xs text-gray-500">
                                Separate hobbies with commas.
                            </p>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center gap-3 border-t border-gray-200 pt-4">
                        <button
                            id="btnSaveMember"
                            type="button"
                            class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
                        >
                            Save member
                        </button>

                        <button
                            type="button"
                            id="cancelModal"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200"
                        >
                            Cancel
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </body>
    <script>
        const user = JSON.parse(localStorage.getItem('user'));
        const modal = document.getElementById('crud-modal');
        const inputNameModal = document.getElementById('name');
        const inputEmailModal = document.getElementById('email');
        const inputHobiModal = document.getElementById('hobbies');
        const btnSaveMember = document.getElementById("btnSaveMember");
        const tableMembers = document.getElementById('tableMembers');

        let editingId = null;
        let membersData = [];

        const members = async () => {
            try {
                const response = await fetch('http://member_api.test/api/members', {
                    method: 'GET',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Authorization': `Bearer ${user.token}` 
                    },
                });

                const result = await response.json();
                if(!response.ok){
                    console.log("Failed fetch members: ", result)
                    return
                }
                membersData = result.data;
                return result;
            } catch (error) {
                console.error(error)
            }
        };

        const renderMembers = async () => {
            const result = await members();
            if(!result) return

            result.data.forEach((member) => {
                tableMembers.innerHTML += `<tr class="border-b border-gray-200 bg-white">
                    <td class="px-7 py-5">${member.name}</td>
                    <td class="px-7 py-5">${member.email}</td>
                    <td class="px-7 py-5">${member.hobbies.join(', ')}</td>
                    <td class="">
                        <button type="button" id="openModalUpdate" onclick="openModal('update', ${member.id})" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Update
                        </button>
                        <button type="button" onclick="confirm('Apakah anda yakin?') ? deleteMember(${member.id}) : ''" class="border border-transparent bg-red-600 px-4 py-2.5 text-sm font-medium leading-5 text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 rounded-lg hover:cursor-pointer">
                            Delete
                        </button>
                    </td>
                </tr>`
            });

            document.getElementById('closeModal').addEventListener('click', closeModal);
        }

        function openModal(mode = 'create', id = null){
            if(mode == 'update'){
                console.log(id)
                member = membersData.find((m) => m.id === id);
                document.getElementById('modal-title').textContent = 'Update Data Member';
                editingId = member.id;
                inputNameModal.value = member.name;
                inputEmailModal.value = member.email;
                inputHobiModal.value = member.hobbies;
            }else{
                editingId = null
                document.getElementById('modal-title').textContent = 'Create Data Member';
                inputNameModal.value = '';
                inputEmailModal.value = '';
                inputHobiModal.value = '';
            }

            modal.classList.remove('hidden');
            modal.classList.add("flex");
        }

        function closeModal(){
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
        
        const createOrUpdateMember = async () => {
            try {
                const URL = editingId !== null ? `http://member_api.test/api/members/${editingId}` : `http://member_api.test/api/members`;
                const response = await fetch(URL, {
                    method: editingId !== null ? 'PUT' : 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Authorization': `Bearer ${user.token}` 
                    },
                    body: JSON.stringify({
                        name: inputNameModal.value,
                        email : inputEmailModal.value,
                        hobbies: inputHobiModal.value
                    })
                });

                const result = await response.json();
                if(!response.ok){
                    console.log(`Failed ${editingId !== null ? 'created' : 'updated'} member: `, result)
                    return
                }

                alert(`Berhasil ${editingId !== null? 'Update!' : 'Menambah data!'}`);

                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } catch (error) {
                console.error(error);
            }            
        }

        btnSaveMember.addEventListener('click', createOrUpdateMember);

        const deleteMember = async (id) => {
            try {
                const response = await fetch(`http://member_api.test/api/members/${id}`, {
                    method: 'DELETE',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Authorization': `Bearer ${user.token}` 
                    },
                });

                if(!response.ok){
                    console.log("Failed to delete member: ", result)
                    return
                }else if(response.ok && response.status === 204){
                    alert("Berhasil menghapus data!")
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000)
                }

            } catch (error) {
                console.error(error)
            }
        };

        document.getElementById('btnLogout').addEventListener('click', async () => {
            try {
                const response = await fetch("http://member_api.test/api/logout",{
                    method: "POST",
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Authorization': `Bearer ${user.token}` 
                    }
                });

                const result = await response.json();
                if(!response.ok){
                    console.error(result);
                    return
                }

                alert("Berhasil logout! Anda akan diarahkan ke halaman login...");
                
                setTimeout(() => {
                    window.location.href = "/";
                }, 2000);

            } catch (error) {
                console.error(error);
            }
        })

        renderMembers();
    </script>
</html>
