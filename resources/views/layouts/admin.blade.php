<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LAPIS Admin - Disdukcapil Bandar Lampung</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "lapis-red": "#d32f2f",
                        "lapis-gold": "#bfa15f",
                        "background-light": "#f8f9fc",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"],
                        "sans": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.375rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                    },
                },
            },
        }
    </script>
    <style>
        .tapis-strip {
            background: linear-gradient(90deg, #d32f2f 0%, #bfa15f 20%, #135bec 40%, #d32f2f 60%, #101622 80%, #bfa15f 100%);
            height: 4px;
            width: 100%;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-display antialiased overflow-hidden">
    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        @include('layouts.admin-sidebar')

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-full relative overflow-hidden">
            <!-- Top Header -->
            <header
                class="h-16 flex items-center justify-between px-6 bg-white dark:bg-[#1a202c] border-b border-slate-200 dark:border-slate-700 shrink-0">
                <div class="flex items-center gap-2">
                    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-700"></div>
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-900 dark:text-white leading-none">
                                {{ Auth::guard('admin')->user()->nama_admin ?? 'Admin' }}
                            </p>
                            <p class="text-xs text-slate-500 mt-1">Super Admin</p>
                        </div>
                        <div class="h-9 w-9 rounded-full bg-slate-200 bg-cover bg-center border border-white shadow-sm"
                            style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()->nama_admin ?? 'Admin') }}&background=135bec&color=fff');">
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-6 md:p-8 scroll-smooth">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
