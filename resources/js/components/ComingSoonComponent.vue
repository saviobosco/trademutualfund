<template>
    <div>
        <!-- begin coming-soon -->
        <div class="coming-soon">
            <!-- begin coming-soon-header -->
            <div class="coming-soon-header">
                <div class="bg-cover"></div>
                <div class="brand">
                    <img src="/images/logo-white.png" alt="Logo" width="200" height="80" >
                </div>
                <div class="desc">
                    Our website is almost there and it’s rebuilt from scratch! A lot of great new features <br />and improvements are coming.
                </div>
                <div class="timer">
                    <div id="timer" class="is-countdown">
					<span class="countdown-row countdown-show4">
						<countdown :time="time_ends">
                            <template slot-scope="props">
								<span class="countdown-section">
									<span class="countdown-amount">{{ props.days }}</span>
									<span class="countdown-period">Days</span>
								</span>
								<span class="countdown-section">
									<span class="countdown-amount">{{ props.hours }}</span>
									<span class="countdown-period">Hours</span>
								</span>
								<span class="countdown-section">
									<span class="countdown-amount">{{ props.minutes }}</span>
									<span class="countdown-period">Minutes</span>
								</span>
								<span class="countdown-section">
									<span class="countdown-amount">{{ props.seconds }}</span>
									<span class="countdown-period">Seconds</span>
								</span>
                            </template>
                        </countdown>
					</span>
                    </div>
                </div>
            </div>
            <!-- end coming-soon-header -->
            <!-- begin coming-soon-content -->
            <div class="coming-soon-content">
                <div class="desc">
                    We are launching soon!<br />.
                </div>

                <p>
                    Join Us on
                    <a href="https://t.me/joinchat/J6CUKkmOJdB3KqAF57_bpA" class="text-inverse"><i class="fa fa-telegram fa-lg fa-fw text-info"></i> Telegram </a>
                </p>
            </div>
            <!-- end coming-soon-content -->
        </div>
        <!-- end coming-soon -->
    </div>
</template>

<script>
    export default {
        name: 'ComingSoonComponent',
        props: ['end_time'],
        data() {
        return {
        };
    },
    computed: {
        time_ends() {
            return (new Date(this.end_time)).getTime() - (new Date()).getTime();
        }
    }
    }
</script>