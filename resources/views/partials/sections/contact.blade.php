<section class="container relative m-auto py-10 mt-10">
    <h2 class="text-4xl text-center font-medium">Contact Me</h2>
    <div class="lg:px-32 mt-10">
        <div style="max-width: 640px;" class="m-auto">
            <div class="relative px-6 sm:px-20">
                <div class="border shadow-xl rounded-2xl p-6 px-8 bg-white">
                    <div class="text-2xl text-center mb-6">Let's talk about your idea</div>
                    <form class="ajax-form" method="POST" action="{{route('tickets.create')}}" clearForm="true">
                        <div class="form-row">
                            <input type="text" name="title" class="input-default input-rounded" placeholder="Name" autocomplete="off">
                            <div class="form-errors" field="title"></div>
                        </div>
                        <div class="form-row">
                            <input type="text" name="email" class="input-default input-rounded" placeholder="Email" autocomplete="off">
                            <div class="form-errors" field="email"></div>
                        </div>
                        <div class="form-row">
                            <textarea name="message" class="input-default input-rounded h-40" placeholder="Message" autocomplete="off"></textarea>
                            <div class="form-errors" field="message"></div>
                        </div>
                        <div class="form-row text-center">
                            @include('partials.submit_button', [
                                'class' => 'btn-default btn-rounded m-auto mb-2 mt-8 w-56 text-lg relative',
                                'label' => 'Submit Message',
                            ])
                        </div>
                    </form>
                </div>
                <img class="hidden contact-form-bg sm:block" src="/assets/images/contact-form.png">
            </div>
        </div>
    </div>
</section>