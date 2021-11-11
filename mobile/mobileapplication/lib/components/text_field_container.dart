import 'package:flutter/material.dart';
import 'package:mobileapplication/components/constants.dart';

class TextFieldContainer extends StatelessWidget {
  final Widget child;
  final double radius;
  const TextFieldContainer({
    Key? key,
    required this.child,
    this.radius = 10,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      margin: EdgeInsets.only(bottom: 5),
      padding: EdgeInsets.symmetric(horizontal: 20, vertical: 5),
      width: size.width,
      decoration: BoxDecoration(
        color: Colors.white,
        border: Border.all(color: Color(0xFFE6E6E6), width: 2),
        borderRadius: BorderRadius.circular(radius),
      ),
      child: child,
    );
  }
}
