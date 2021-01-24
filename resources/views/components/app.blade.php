<x-master>
    <section class="px-8">
        <main class="container mx-auto">
            <div class="flex flex-col lg:flex-row lg:justify-center">
                <div class="order-1 lg:order-1 lg:w-44 my-4 lg:my-0">
                    @include ('_sidebar-links')
                </div>

                <div class="order-2 lg:order-2 lg:flex-1 lg:mx-10 lg:mb-10" style="max-width: 700px">
                    {{ $slot }}
                </div>

                <div class="order-3 lg:order-3 lg:w-1/6 mt-4 lg:mt-0">
                    @include ('_friends-list')
                </div>
            </div>
        </main>
    </section>
</x-master>
