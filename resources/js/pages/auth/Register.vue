<script setup lang="ts">
import { store } from '@/routes/register';
import { login } from '@/routes';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Form } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
</script>

<template>
    <div class="flex h-screen bg-[url(/images/background.jpeg)] bg-cover">
        <div class="flex w-2/3 flex-col items-center justify-center gap-20 p-30">
            <img src="/images/logo.png" class="w-36" />
            <h1 class="text-center text-4xl font-bold">
                La forma simple de gestionar tus clientes y su historial.
            </h1>
            <div class="grid w-full grid-cols-3 gap-10">
                <div
                    class="flex flex-col gap-3 rounded-lg bg-white p-10 shadow-md"
                >
                    <img src="/images/icon-users.png" class="w-20" />
                    <div class="text-xl font-bold">Para profesionales</div>
                    <p class="font-semibold text-gray-600">
                        Perfecto para profesionales independientes que necesitan
                        organizar la información de sus clientes: terapeutas,
                        especialistas en bienestar, consultores o cualquier
                        profesional que trabaje de forma personalizada con
                        personas.
                    </p>
                </div>
                <div
                    class="flex flex-col gap-3 rounded-lg bg-white p-10 shadow-md"
                >
                    <img src="/images/icon-profile.png" class="w-20" />
                    <div class="text-xl font-bold">Gestión de clientes</div>
                    <div class="font-semibold text-gray-600">
                        <p>
                            Administra toda la información de tus clientes en un
                            solo lugar.
                        </p>
                        <p>
                            Crea campos personalizados según tu tipo de servicio
                            y tu forma de trabajar.
                        </p>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-3 rounded-lg bg-white p-10 shadow-md"
                >
                    <img src="/images/icon-edit.png" class="w-20" />
                    <div class="text-xl font-bold">Historial flexible</div>
                    <div class="font-semibold text-gray-600">
                        <p>
                            Registra el historial de cada cliente como
                            prefieras:
                        </p>
                        <p>• Un editor libre para escribir notas rápidamente</p>
                        <p>
                            • Formularios estructurados con campos
                            personalizados
                        </p>
                        <p>Tú decides el nivel de detalle.</p>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-3 rounded-lg bg-white p-10 shadow-md"
                >
                    <img src="/images/icon-clip.png" class="w-20" />
                    <div class="text-xl font-bold">Archivos y documentos</div>
                    <div class="font-semibold text-gray-600">
                        <p>
                            Adjunta documentos, PDFs, imágenes o fotos
                            directamente en el perfil del cliente.
                        </p>
                        <p>
                            Todo organizado y fácil de consultar cuando lo
                            necesites.
                        </p>
                    </div>
                </div>
                <div
                    class="flex flex-col gap-3 rounded-lg bg-white p-10 shadow-md"
                >
                    <img src="/images/icon-rocket.png" class="w-20" />
                    <div class="text-xl font-bold">Empieza gratis</div>
                    <div class="font-semibold text-gray-600">
                        <p>Completamente gratis, sin límites.</p>
                        <p>Crea tu cuenta y empieza a usar SmartErm en minutos.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex w-1/3 h-full flex-col p-10">
            <div
                class="flex h-full flex-col items-center justify-center gap-10 rounded-lg bg-white p-20"
            >
                <div class="flex flex-col items-center">
                    <div class="mb-2 text-lg font-bold">Crea tu cuenta</div>
                    <div class="text-gray-400">
                        Empieza a usar SmartErm en menos de un minuto.
                    </div>
                    <div class="text-gray-400">Gratis y sin límites.</div>
                </div>
                <Form
                    v-bind="store.form()"
                    :reset-on-success="['password', 'password_confirmation']"
                    v-slot="{ errors, processing }"
                    class="flex w-full flex-col gap-6"
                >
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="name">Nombre</Label>
                            <Input
                                id="name"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="name"
                                name="name"
                                placeholder="Nombre completo"
                            />
                            <InputError :message="errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Correo electrónico</Label>
                            <Input
                                id="email"
                                type="email"
                                required
                                :tabindex="2"
                                autocomplete="email"
                                name="email"
                                placeholder="email@example.com"
                            />
                            <InputError :message="errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">Contraseña</Label>
                            <Input
                                id="password"
                                type="password"
                                required
                                :tabindex="3"
                                autocomplete="new-password"
                                name="password"
                                placeholder="Contraseña"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation"
                                >Confirmar contraseña</Label
                            >
                            <Input
                                id="password_confirmation"
                                type="password"
                                required
                                :tabindex="4"
                                autocomplete="new-password"
                                name="password_confirmation"
                                placeholder="Confirmar contraseña"
                            />
                            <InputError
                                :message="errors.password_confirmation"
                            />
                        </div>

                        <Button
                            type="submit"
                            class="w-full cursor-pointer rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"
                            tabindex="5"
                            :disabled="processing"
                            data-test="register-user-button"
                        >
                            <Spinner v-if="processing" />
                            Crear cuenta
                        </Button>
                    </div>

                    <div class="text-center text-sm text-muted-foreground">
                        Ya tienes una cuenta?
                        <TextLink
                            :href="login()"
                            class="text-sm font-semibold !text-blue-500 hover:text-blue-600"
                            :tabindex="6"
                            >Ingresar</TextLink
                        >
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
