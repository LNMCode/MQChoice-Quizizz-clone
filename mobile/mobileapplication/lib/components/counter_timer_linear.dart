import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:mobileapplication/components/constants.dart';

class CounterTimerLinear extends StatefulWidget {
  final Size size;
  final int time;
  final int timedelay;
  final Function() onFinish;

  const CounterTimerLinear({
    Key? key,
    required this.size,
    this.time = 5,
    this.timedelay = 1,
    required this.onFinish,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _CounterTimeLineaer();
}

class _CounterTimeLineaer extends State<CounterTimerLinear>
    with SingleTickerProviderStateMixin {
  late AnimationController controller;

  @override
  void initState() {
    print('Time counter ${widget.time + widget.timedelay}');
    controller = AnimationController(
      vsync: this,
      duration: Duration(seconds: widget.time + widget.timedelay),
    )..addListener(() {
        setState(() {
          if (controller.value > 0.99) {
            widget.onFinish();
            controller.stop();
          }
        });
      });

    controller.repeat(reverse: false);
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    Size size = widget.size;
    return Container(
      width: size.width,
      child: LinearProgressIndicator(
        value: controller.value,
        color: kPrimaryColor,
        semanticsLabel: 'Linear progress indicator',
      ),
    );
  }

  @override
  void dispose() {
    controller.dispose();
    super.dispose();
  }
}
