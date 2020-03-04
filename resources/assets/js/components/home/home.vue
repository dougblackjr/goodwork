<template>
	<div id="home-container" v-if="activeTab === 'home'">
		<div class="flex flex-wrap -mx-2">
			<div class="w-full md:w-1/2 bg-white rounded-lg shadow p-8 px-2">
				<div class="text-xl">
					What's In Progress ⬇️
				</div>
				<div v-if="currentWork.length === 0" class="mt-4">There is currently no work "In Progress" assigned to you</div>
				<a v-if="currentWork.length !== 0" :href="'/' + currentWork[0].taskable_type + 's/' + currentWork[0].taskable_id + '?tool=tasks&id=' + currentWork[0].id" class="block mt-4 p-4 rounded-lg bg-gray-100 border-2 border-indigo-300 cursor-pointer">
					<div class="flex items-center">
						<div class="pr-2 text-sm">Due on: </div>
						<div class="text-sm rounded-full px-3 py-1 bg-indigo-200 text-indigo-700 font-semibold inline">
							{{ dueOn(currentWork[0].due_on) }}
						</div>
					</div>
					<div class="text-2xl font-medium">
						{{ currentWork[0].name }}
					</div>
					<div class="text-lg">
						{{ currentWork[0].notes }}
					</div>
					<div class="py-4">
						<div class="text-lg font-medium border-b-2 pb-1">
							Progress
						</div>
						<!-- Progress list -->
						<div v-if="currentWork.length !== 0 && currentWork[0].steps.length === 0" class="pt-2">
							No progress update yet
						</div>
						<div v-for="step in currentWork[0].steps" class="bg-white rounded shadow px-4 py-2 my-4">
							<div class="text-xs text-indigo-700">
								<span class="text-gray-700">Last updated:</span> {{ step.updated_at }}
							</div>
							<div class="text-2xl">
								{{ step.description }}
							</div>
							<div class="flex">
								<div class="py-2 pr-4 text-gray-700">
									<input type="checkbox" :id="'step-done-' + step.id" class="checkbox" :checked="step.done">
									<label :for="'step-done-' + step.id">Done</label>
								</div>
								<div class="py-2 text-gray-700">
									<input type="checkbox" :id="'step-unknown-' + step.id" class="checkbox" :checked="step.unknown">
									<label :for="'step-unknown-' + step.id">Unknown</label>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="w-full md:w-1/2 bg-white rounded-lg shadow p-8 px-2">
				<div class="text-xl">
					What's Assigned 💣
				</div>
				<div v-if="currentAssigned.length === 0" class="mt-4">There is currently no work assigned to you!</div>
				<a v-if="currentAssigned.length !== 0" :href="'/' + currentAssigned[0].taskable_type + 's/' + currentAssigned[0].taskable_id + '?tool=tasks&id=' + currentAssigned[0].id" class="block mt-4 p-4 rounded-lg bg-gray-100 border-2 border-indigo-300 cursor-pointer">
					<div class="flex items-center">
						<div class="pr-2 text-sm">Due on: </div>
						<div class="text-sm rounded-full px-3 py-1 bg-indigo-200 text-indigo-700 font-semibold inline">
							{{ dueOn(currentAssigned[0].due_on) }}
						</div>
					</div>
					<div class="text-2xl font-medium">
						{{ currentAssigned[0].name }}
					</div>
					<div class="text-lg">
						{{ currentAssigned[0].notes }}
					</div>
					<div class="py-4">
						<div class="text-lg font-medium border-b-2 pb-1">
							Progress
						</div>
						<!-- Progress list -->
						<div v-if="currentAssigned.length !== 0 && currentAssigned[0].steps.length === 0" class="pt-2">
							No progress update yet
						</div>
						<div v-for="step in currentAssigned[0].steps" class="bg-white rounded shadow px-4 py-2 my-4">
							<div class="text-xs text-indigo-700">
								<span class="text-gray-700">Last updated:</span> {{ step.updated_at }}
							</div>
							<div class="text-2xl">
								{{ step.description }}
							</div>
							<div class="flex">
								<div class="py-2 pr-4 text-gray-700">
									<input type="checkbox" :id="'step-done-' + step.id" class="checkbox" :checked="step.done">
									<label :for="'step-done-' + step.id">Done</label>
								</div>
								<div class="py-2 text-gray-700">
									<input type="checkbox" :id="'step-unknown-' + step.id" class="checkbox" :checked="step.unknown">
									<label :for="'step-unknown-' + step.id">Unknown</label>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="w-full md:w-1/2 bg-white rounded-lg shadow p-8 px-2" v-if="1==2">
				<div v-if="currentWork.length !== 0" class="pt-8 flex items-center pb-4">
					<div class="text-base mr-2">
						Other tasks in progress 
					</div>
					<div class="text-xs font-bold bg-indigo-600 text-white flex items-center justify-center w-6 h-6 rounded-full">{{ currentWork.length - 1 }}</div>
				</div>
				<a :href="'/' + task.taskable_type + 's/' + task.taskable_id + '?tool=tasks&id=' + task.id" v-if="index !== 0" v-for="(task, index) in currentWork" class="block bg-gray-100 rounded shadow px-4 py-2 my-4">
					<div class="text-blue-500 text-sm cursor-pointer">
						{{ task.taskable.name }}
					</div>
					<div class="text-lg">
						{{ task.name }}
					</div>
				</a>
			</div>
			<div class="w-full md:w-1/2 bg-white rounded-lg shadow p-8 px-2" v-if="1==2">
				<div v-if="currentWork.length !== 0" class="pt-8 flex items-center pb-4">
					<div class="text-base mr-2">
						Latest Convo
					</div>
					<div class="text-xs font-bold bg-indigo-600 text-white flex items-center justify-center w-6 h-6 rounded-full">{{ currentWork.length - 1 }}</div>
				</div>
				<a :href="'/' + task.taskable_type + 's/' + task.taskable_id + '?tool=tasks&id=' + task.id" v-if="index !== 0" v-for="(task, index) in currentWork" class="block bg-gray-100 rounded shadow px-4 py-2 my-4">
					<div class="text-blue-500 text-sm cursor-pointer">
						{{ task.taskable.name }}
					</div>
					<div class="text-lg">
						{{ task.name }}
					</div>
				</a>
			</div>
		</div>
		<div class="h-16"></div>
	</div>
</template>

<script>
import { mapState } from 'vuex'

export default {
	props: {
		activeTab: {
			required: true,
			type: String
		}
	},

	computed: {
		...mapState({
			currentWork: state => state.currentWork,
			currentAssigned: state => state.currentAssigned
		})
	},

	methods: {
		dueOn: function (value) {
			return luxon.DateTime.fromSQL(value).toFormat('d LLL')
		},
	}
}
</script>

<style>

</style>
