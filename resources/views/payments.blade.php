<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form
                    x-data="{
                        stripe : null,
                        cardElement : null,
                        init(){
                            //create a stripe instance
                            this.stripe = Stripe('{{config("stripe.key")}}');
                            const elements=this.stripe.elements();
                            this.cardElement=elements.create('card',{})
                            this.cardElement.mount('#card-element')
                        }
                    }"
                    >
                        <div id="card-element"></div>
                        <x-primary-button class="mt-3">Make Payment</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>