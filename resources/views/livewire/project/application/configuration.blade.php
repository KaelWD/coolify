<div>
    <h1>Configuration</h1>
    <livewire:project.application.heading :application="$application" />
    <div x-data="{ activeTab: window.location.hash ? window.location.hash.substring(1) : 'general' }" class="flex h-full pt-6">
        <div class="flex flex-col gap-4 xl:w-48">
            <a :class="activeTab === 'general' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'general'; window.location.hash = 'general'" href="#">General</a>
            @if ($application->destination->server->isSwarm())
                <a :class="activeTab === 'swarm' && 'dark:text-white text-black'"
                    @click.prevent="activeTab = 'swarm'; window.location.hash = 'swarm'" href="#">Swarm
                    Configuration</a>
            @endif
            <a :class="activeTab === 'advanced' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'advanced'; window.location.hash = 'advanced'" href="#">Advanced</a>
            @if ($application->build_pack !== 'static')
                <a :class="activeTab === 'environment-variables' && 'dark:text-white text-black'"
                    @click.prevent="activeTab = 'environment-variables'; window.location.hash = 'environment-variables'"
                    href="#">Environment
                    Variables</a>
            @endif
            @if ($application->build_pack !== 'static' && $application->build_pack !== 'dockercompose')
                <a :class="activeTab === 'storages' && 'dark:text-white text-black'"
                    @click.prevent="activeTab = 'storages'; window.location.hash = 'storages'" href="#">Storages
                </a>
            @endif
            @if ($application->git_based())
                <a :class="activeTab === 'source' && 'dark:text-white text-black'"
                    @click.prevent="activeTab = 'source'; window.location.hash = 'source'" href="#">Source</a>
            @endif
            <a :class="activeTab === 'servers' && 'dark:text-white text-black'" class="flex items-center gap-2"
                @click.prevent="activeTab = 'servers'; window.location.hash = 'servers'" href="#">Servers
                @if (str($application->status)->contains('degraded'))
                    <span title="Some servers are unavailable">
                        <svg class="w-4 h-4 text-error" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M240.26 186.1L152.81 34.23a28.74 28.74 0 0 0-49.62 0L15.74 186.1a27.45 27.45 0 0 0 0 27.71A28.31 28.31 0 0 0 40.55 228h174.9a28.31 28.31 0 0 0 24.79-14.19a27.45 27.45 0 0 0 .02-27.71m-20.8 15.7a4.46 4.46 0 0 1-4 2.2H40.55a4.46 4.46 0 0 1-4-2.2a3.56 3.56 0 0 1 0-3.73L124 46.2a4.77 4.77 0 0 1 8 0l87.44 151.87a3.56 3.56 0 0 1 .02 3.73M116 136v-32a12 12 0 0 1 24 0v32a12 12 0 0 1-24 0m28 40a16 16 0 1 1-16-16a16 16 0 0 1 16 16" />
                        </svg>
                    </span>
                @endif
            </a>
            <a :class="activeTab === 'scheduled-tasks' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'scheduled-tasks'; window.location.hash = 'scheduled-tasks'"
                href="#">Scheduled Tasks
            </a>

            <a :class="activeTab === 'webhooks' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'webhooks'; window.location.hash = 'webhooks'" href="#">Webhooks
            </a>
            @if ($application->git_based())
                <a :class="activeTab === 'previews' && 'dark:text-white text-black'"
                    @click.prevent="activeTab = 'previews'; window.location.hash = 'previews'" href="#">Preview
                    Deployments
                </a>
            @endif
            @if ($application->build_pack !== 'static' && $application->build_pack !== 'dockercompose')
                <a :class="activeTab === 'health' && 'dark:text-white text-black'"
                    @click.prevent="activeTab = 'health'; window.location.hash = 'health'" href="#">Healthchecks
                </a>
            @endif
            <a :class="activeTab === 'rollback' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'rollback'; window.location.hash = 'rollback'" href="#">Rollback
            </a>
            @if ($application->build_pack !== 'dockercompose')
                <a :class="activeTab === 'resource-limits' && 'dark:text-white text-black'"
                    @click.prevent="activeTab = 'resource-limits'; window.location.hash = 'resource-limits'"
                    href="#">Resource Limits
                </a>
            @endif
            <a :class="activeTab === 'resource-operations' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'resource-operations'; window.location.hash = 'resource-operations'"
                href="#">Resource Operations
            </a>
            <a :class="activeTab === 'tags' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'tags'; window.location.hash = 'tags'" href="#">Tags
            </a>
            <a :class="activeTab === 'danger' && 'dark:text-white text-black'"
                @click.prevent="activeTab = 'danger'; window.location.hash = 'danger'" href="#">Danger Zone
            </a>
        </div>
        <div class="w-full pl-8">
            <div x-cloak x-show="activeTab === 'general'" class="h-full">
                <livewire:project.application.general :application="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'swarm'" class="h-full">
                <livewire:project.application.swarm :application="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'advanced'" class="h-full">
                <livewire:project.application.advanced :application="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'environment-variables'">
                <livewire:project.shared.environment-variable.all :resource="$application" />
            </div>
            @if ($application->git_based())
                <div x-cloak x-show="activeTab === 'source'">
                    <livewire:project.application.source :application="$application" />
                </div>
            @endif
            <div x-cloak x-show="activeTab === 'servers'">
                <livewire:project.shared.destination :resource="$application" :servers="$servers" />
            </div>
            <div x-cloak x-show="activeTab === 'storages'">
                <livewire:project.service.storage :resource="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'webhooks'">
                <livewire:project.shared.webhooks :resource="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'previews'">
                <livewire:project.application.previews :application="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'health'">
                <livewire:project.shared.health-checks :resource="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'rollback'">
                <livewire:project.application.rollback :application="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'resource-limits'">
                <livewire:project.shared.resource-limits :resource="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'scheduled-tasks'">
                <livewire:project.shared.scheduled-task.all :resource="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'resource-operations'">
                <livewire:project.shared.resource-operations :resource="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'tags'">
                <livewire:project.shared.tags :resource="$application" />
            </div>
            <div x-cloak x-show="activeTab === 'danger'">
                <livewire:project.shared.danger :resource="$application" />
            </div>
        </div>
    </div>
</div>
