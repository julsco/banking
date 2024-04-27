<template>
    <div class="">
        <q-layout view="hHh Lpr lff" container style="height: 100vh" class="shadow-2 rounded-borders">
<!--            <q-header elevated :class="$q.dark.isActive ? 'bg-secondary' : 'bg-black'">-->
<!--                <q-toolbar>-->
<!--                    <i class="fa-solid fa-bars cursor-pointer" @click="drawer = !drawer"/>-->
<!--                    <q-toolbar-title>Banking</q-toolbar-title>-->
<!--                </q-toolbar>-->
<!--            </q-header>-->

            <q-drawer
                v-model="drawer"
                show-if-above

                :mini="miniState"
                @mouseover="miniState = false"
                @mouseout="miniState = true"

                :width="200"
                :breakpoint="500"
                bordered
                :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'"
            >
                <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
                    <q-list padding>
                        <div v-for="(navItem, i) in mainNavItems" :key="i">
                            <q-item clickable v-ripple>
                                <q-item-section avatar>
                                    <i class="fa-solid cursor-pointer" :class="navItem.icon"/>
                                </q-item-section>

                                <q-item-section>
                                    {{ navItem.title }}
                                </q-item-section>
                            </q-item>
                        </div>

                        <q-separator />

                        <div v-for="(navItem, i) in utilityNavItems" :key="i">
                            <q-item clickable v-ripple>
                                <q-item-section avatar>
                                    <i class="fa-solid cursor-pointer" :class="navItem.icon"/>
                                </q-item-section>

                                <q-item-section>
                                    {{ navItem.title }}
                                </q-item-section>
                            </q-item>
                        </div>
                    </q-list>
                </q-scroll-area>
            </q-drawer>

            <q-page-container>
                <q-page padding>
                    <slot/>
                </q-page>
            </q-page-container>
        </q-layout>
    </div>
</template>

<script>
export default {
    name: 'BankingLayout',
    data() {
        return {
            drawer: false,
            miniState: true,
            mainNavItems: [
                {
                    title: 'Dashboard',
                    icon: 'fa-house',
                    href: '/dashboard',
                },
                {
                    title: 'Bank Accounts',
                    icon: 'fa-building-columns',
                    href: '/bank-accounts',
                }
            ],
            utilityNavItems: [
                {
                    title: 'Settings',
                    icon: 'fa-gear',
                    href: '/settings',
                },
                {
                    title: 'Logout',
                    icon: 'fa-right-from-bracket',
                    href: '/settings',
                },
            ],
        };
    },
}
</script>
