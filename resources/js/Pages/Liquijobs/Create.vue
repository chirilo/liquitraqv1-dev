<script setup>
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';


const form = useForm({
    so_number: '',
    building: '',
    city : '',
    state : '',
    status : '',
    expected_qty : '',
    serial_number : '',
    hid_employee_name : '',
    hid_employee_id : '',
    liquis_pickup_date : '',
    liquis_employee_name : '',
    invoice_number : '',
    liquis_complete_photo : '',
    additional_images: ''
});

const submit = () => {
    form.post(route("liquijobs.store"));
};
</script>
<template>
    <Head title="Create Blog" />

    <!-- <AuthenticatedLayout> -->
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Blog</h2>
        </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <section>
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        
                        <div>
                            <InputLabel for="so_number" value="SO Number" />

                            <TextInput
                                id="so_number"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.so_number"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.so_number" />
                        </div>

                        <div>
                            <InputLabel for="building" value="Building" />

                            <TextInput
                                id="building"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.building"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.building" />
                        </div>

                        <div>
                            <InputLabel for="city" value="City" />

                            <TextInput
                                id="city"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.city"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.city" />
                        </div>

                        <div>
                            <InputLabel for="state" value="State" />

                            <TextInput
                                id="state"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.state"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.state" />
                        </div>

                        <div>
                            <InputLabel for="status" value="Status" />

                            <TextInput
                                id="status"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.status"
                                required
                                autofocus
                            />
                            <!-- <v-select
							  label="Select"
							  :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
							></v-select> -->

                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>

                        <div>
                            <InputLabel for="expected_qty" value="Expected Quantity" />

                            <TextInput
                                id="expected_qty"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.expected_qty"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.expected_qty" />
                        </div>

                        <div>
                            <InputLabel for="serial_number" value="Serial Number" />

                            <TextInput
                                id="serial_number"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.serial_number"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.serial_number" />
                        </div>

                        <div>
                            <InputLabel for="hid_employee_name" value="HID Employee Name" />

                            <TextInput
                                id="hid_employee_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.hid_employee_name"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.hid_employee_name" />
                        </div>

                        <div>
                            <InputLabel for="hid_employee_id" value="HID Employee ID" />

                            <TextInput
                                id="hid_employee_id"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.hid_employee_id"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.hid_employee_id" />
                        </div>

                        <div>
                            <InputLabel for="liquis_pickup_date" value="Liquis Pickup Date" />

                            <TextInput
                                id="liquis_pickup_date"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.liquis_pickup_date"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.liquis_pickup_date" />
                        </div>

                        <div>
                            <InputLabel for="liquis_employee_name" value="Liquis Employee Name" />

                            <TextInput
                                id="liquis_employee_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.liquis_employee_name"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.liquis_employee_name" />
                        </div>

                        <div>
                            <InputLabel for="invoice_number" value="Invoice Number" />

                            <TextInput
                                id="invoice_number"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.invoice_number"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.invoice_number" />
                        </div>

                        <div>
                            <InputLabel for="liquis_complete_photo" value="Liquis Complete Photo" />

                            <TextInput
                                id="liquis_complete_photo"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.liquis_complete_photo"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.liquis_complete_photo" />
                        </div>

                        <div>
                            <InputLabel for="additional_images" value="Additional Images" />

                            <TextInput
                                id="additional_images"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.additional_images"
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.additional_images" />
                        </div>

                        <!-- <div>
                            <InputLabel for="slug" value="Slug" />

                            <TextInput
                                id="slug"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.slug"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.slug" />
                        </div>
                        <div>
                            <InputLabel for="description" value="Description" />

                            <TextArea
                                id="description"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.description"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div> -->

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    <!-- </AuthenticatedLayout> -->
</template>