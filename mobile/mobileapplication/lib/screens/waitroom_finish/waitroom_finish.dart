import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class WaitRoomFinishScreen extends StatefulWidget {
  final String idroom;
  final String iduser;

  const WaitRoomFinishScreen({
    Key? key,
    required this.idroom,
    required this.iduser,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _WaitRoomFinishScreen();
}

class _WaitRoomFinishScreen extends State<WaitRoomFinishScreen> {
  @override
  void initState() {
    super.initState();
    // Connect to socket server to wait finish room
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(),
    );
  }
}
