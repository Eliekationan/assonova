<template>
  <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
    <canvas ref="canvas"></canvas>
  </div>
</template>

<script>
import { onMounted, ref } from 'vue'
import { Chart, registerables } from 'chart.js'
Chart.register(...registerables)

export default {
  props: {
    labels: { type: Array, default: () => ['Jan','Feb','Mar','Apr','May','Jun'] },
    seriesA: { type: Array, default: () => [120, 90, 150, 220, 180, 260] }, // blue
    seriesB: { type: Array, default: () => [80, 60, 90, 110, 95, 120] } // yellow
  },
  setup(props) {
    const canvas = ref(null)
    let chart = null

    onMounted(() => {
      const ctx = canvas.value.getContext('2d')
      chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: props.labels,
          datasets: [
            {
              label: 'Femme',
              data: props.seriesB,
              backgroundColor: '#EAB308',
              stack: 'stack1'
            },
            {
              label: 'Homme',
              data: props.seriesA,
              backgroundColor: '#1C6279',
              stack: 'stack1'
            },
            {
              type: 'line',
              label: 'Tendance',
              data: props.seriesA.map((v,i) => (props.seriesA[i]+props.seriesB[i])),
              borderColor: '#EAB308',
              backgroundColor: 'transparent',
              tension: 0.3,
              pointBackgroundColor: '#fff',
              pointBorderColor: '#EAB308',
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false }
          },
          scales: {
            y: {
              grid: { color: '#eef2f6' },
              beginAtZero: true
            },
            x: {
              grid: { display: false }
            }
          }
        }
      })
    })

    return { canvas }
  }
}
</script>

<style scoped>
div { height: 320px; } /* chart container height */
</style>
